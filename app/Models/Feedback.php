<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feedback extends Model
{
    protected $table = 'feedback';

    public function poster() : BelongsTo
    {
        return $this->belongsTo(User::class, 'poster_id', 'id');
    }

    public function resume() : BelongsTo
    {
        return $this->belongsTo(Resume::class, 'id', 'resume_id');
    }

    public function setResumeId(int $resumeId)
    {
        $this->resume_id = $resumeId;
    }

    public function setPosterId(int $posterId)
    {
        $this->poster_id = $posterId;
    }

    public function setFeedback(string $feedback)
    {
        $this->feedback = $feedback;
    }

    public function getFeedback() : string
    {
        return $this->feedback;
    }

    public function getCreatedAt() : Carbon
    {
        return $this->created_at;
    }
}
