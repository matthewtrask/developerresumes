<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResumeUploadRequest;
use App\Models\Resume;
use App\Transformers\ResumeTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ResumeController extends Controller
{
    /**
     * @var Resume
     */
    protected $resume;

    /**
     * @var ResumeTransformer
     */
    protected $resumeTransformer;

    /**
     * @var Response
     */
    protected $response;

    public function __construct(Resume $resume, ResumeTransformer $resumeTransformer, Response $response)
    {
        $this->resume = $resume;
        $this->resumeTransformer = $resumeTransformer;
        $this->response = $response;
    }

    public function index() : Response
    {
        $resumes = Resume::all();

        return $this->response
            ->setContent(fractal($resumes)->transformWith($this->resumeTransformer)->parseIncludes('profile')->toArray());
    }

    /**
     * @param int $resumeId
     *
     * @return JsonResponse
     */
    public function getResume(int $resumeId) : Response
    {
        $resume = $this->resume->findOrFail($resumeId);

        return $this->response
            ->setContent(fractal($resume)->transformWith($this->resumeTransformer)->parseIncludes(['profile', 'feedback'])->toArray());
    }

    /**
     * @param int $resumeId
     *
     * @return mixed
     */
    public function downloadResume(int $resumeId)
    {
        $resume = $this->resume->findOrFail($resumeId);

        return response()->file($resume->resume);
    }

    /**
     * @param ResumeUploadRequest $request
     *
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     *
     * @return JsonResponse
     */
    public function upload(ResumeUploadRequest $request): JsonResponse
    {
        $user = $request->user();
        $file = $request->file('file');

        $path = Storage::disk('s3')->putFileAs(
            snake_case($user->name),
            $file,
            'resume.'.$file->guessExtension());

        Storage::disk('s3')->setVisibility(snake_case($user->name).'/'.'resume.'.$file->guessExtension(), 'public');

        $resume = $this->resume->fill([
            'user_id' => $user->id,
            'resume'  => $path,
        ])->save();

        return response()->json($resume);
    }

    /**
     * @param Request $request
     * @param int     $resumeId
     *
     * @return JsonResponse
     */
    public function delete(Request $request, int $resumeId): JsonResponse
    {
        $userId = $request->user()->userId();

        $resume = $this->resume->byUser($userId)->byResume($resumeId)->first();

        Storage::disk('s3')->delete(snake_case($request->user()->name).'/'.'resume.pdf');

        $resume->delete();

        return response()->json([], 204);
    }
}
