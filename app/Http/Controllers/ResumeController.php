<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResumeUploadRequest;
use App\Models\Resume;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ResumeController extends Controller
{
    /**
     * @param int $resumeId
     *
     * @return View
     */
    public function getResume(int $resumeId): View
    {
        $resume = Resume::findOrFail($resumeId);

        return view('resume', ['resume' => $resume]);
    }

    /**
     * @param int $resumeId
     *
     * @return mixed
     */
    public function downloadResume(int $resumeId)
    {
        $resume = Resume::findOrFail($resumeId);

        return response()->file($resume->resume);
    }

    /**
     * @param ResumeUploadRequest $request
     *
     * @return JsonResponse
     */
    public function upload(ResumeUploadRequest $request): JsonResponse
    {
        $user = $request->user();
        $file = $request->file('resume');

        $path = $file->storeAs(
            snake_case($user->name),
            $this->getNewFilename($file)
        );

        $resume = Resume::create([
            'user_id' => $user->id,
            'resume'  => $path
        ]);

        return response()->json($resume);
    }

    /**
     * @param UploadedFile $file
     *
     * @return string
     */
    protected function getNewFilename(UploadedFile $file): string
    {
        $ext = $file->guessExtension();

        return sprintf(
            'resume.%s',
            $ext
        );
    }
}
