<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feedback extends Model
{
    protected $table = 'feedback';

    public function getId()
    {
        return $this->id;
    }

    public function poster() : BelongsTo
    {
        return $this->belongsTo(User::class, 'poster_id', 'id');
    }

    public function resume() : BelongsTo
    {
        return $this->belongsTo(Resume::class, 'resume_id', 'id');
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

    public function setModerated(int $value)
    {
        $this->moderated = $value;
    }

    public function getFeedback() : string
    {
        return $this->feedback;
    }

    public function getModerated() : bool
    {
        return $this->moderated;
    }

    public function getCreatedAt() : Carbon
    {
        return $this->created_at;
    }

    public function scopeById(Builder $query, int $id)
    {
        return $query->where('id', '=', $id);
    }

    public function scopeNotModerated(Builder $query)
    {
        return $query->where('moderated', '=', 0);
    }
}
