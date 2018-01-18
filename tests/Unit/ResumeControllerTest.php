<?php

namespace Tests\Unit;

use App\Http\Controllers\ResumeController;
use App\Http\Requests\ResumeUploadRequest;
use App\Models\Resume;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ResumeControllerTest extends TestCase
{
    public function testGetResume()
    {
        $resumeId = 123;
        $resume = factory(Resume::class)
            ->make(['id' => $resumeId]);

        $mock = \Mockery::mock(Resume::class);
        $mock->shouldReceive('findOrFail')
            ->with($resumeId)
            ->andReturn($resume);

        $controller = new ResumeController($mock);

        $response = $controller->getResume($resumeId);
        $this->assertInstanceOf(JsonResponse::class, $response);

        $content = json_decode($response->getContent(), true);
        $this->assertSame($resumeId, $content['id']);
    }

    public function testDownloadResume()
    {
        $resumeId = 123;
        $resume = factory(Resume::class)->make(['id' => $resumeId]);

        $mock = \Mockery::mock(Resume::class);
        $mock->shouldReceive('findOrFail')
            ->with($resumeId)
            ->andReturn($resume);

        $controller = new ResumeController($mock);
        $response = $controller->getResume($resumeId);
        $this->assertInstanceOf(JsonResponse::class, $response);
    }

    public function testUpload()
    {
        $file = UploadedFile::fake()->create('resume.pdf', 500);
        $user = factory(User::class)->make(['user_id' => 123]);

        $request = \Mockery::mock(ResumeUploadRequest::class);
        $request->shouldReceive('user')->andReturn($user);
        $request->shouldReceive('file')->with('resume')->andReturn($file);

        Storage::fake('resumes');

        $mock = \Mockery::mock(Resume::class);
        $mock->shouldReceive('fill')
            ->andReturnSelf();
        $mock->shouldReceive('save')->andReturn(true);

        $controller = new ResumeController($mock);

        $response = $controller->upload($request);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $data = json_decode($response->getContent(), true);

        $this->assertSame($user->id, $data['user_id']);

        $uploadedFile = 'resumes/'. snake_case($user->name). '/resume.pdf';
        Storage::disk()->assertExists($uploadedFile);
    }
}
