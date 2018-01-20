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

    public function index()
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
    public function getResume(int $resumeId): JsonResponse
    {
        $resume = $this->resume->findOrFail($resumeId);

        return response()->json($resume->toArray());
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
     * @return JsonResponse
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function upload(ResumeUploadRequest $request): JsonResponse
    {
        $user = $request->user();
        $file = $request->file('resume');

        $path = Storage::putFileAs(
            'resumes/'. snake_case($user->name),
            $file,
            'resume.' . $file->guessExtension()
        );

        $resume = $this->resume->fill([
            'user_id' => $user->id,
            'resume'  => $path
        ])->save();

        return response()->json($resume);
    }

    /**
     * @param Request $request
     * @param int     $resumeId
     *
     * @return JsonResponse
     */
    public function deleteResume(Request $request, int $resumeId): JsonResponse
    {
        $user = $request->user();

        $resume = $this->resume
            ->where('user_id', $user->id)
            ->where('id', $resumeId)
            ->findOrFail();

        $resume->delete();

        return response()->json([], 204);
    }
}
