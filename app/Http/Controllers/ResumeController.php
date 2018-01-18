<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResumeUploadRequest;
use App\Models\Resume;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class ResumeController extends Controller
{
    /**
     * @var Resume
     */
    protected $resume;

    /**
     * ResumeController constructor.
     *
     * @param Resume $resume
     */
    public function __construct(Resume $resume)
    {
        $this->resume = $resume;
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
     * @param int $resumeId
     *
     * @return JsonResponse
     */
    public function deleteResume(int $resumeId): JsonResponse
    {
        $this->resume->destroy([$resumeId]);

        return response()->json(['success'], 204);
    }
}
