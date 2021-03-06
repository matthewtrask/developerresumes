<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Resume.
 *
 *
 * @property int    $id
 * @property int    $user_id
 * @property User   $user
 * @property string $resume
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Resume extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'resume',
        'created_at',
        'updated_at',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function feedback() : HasMany
    {
        return $this->hasMany(Feedback::class, 'resume_id', 'id');
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id'         => $this->getAttribute('id'),
            'path'       => $this->getAttribute('resume'),
            'created_at' => $this->created_at->toIso8601String(),
        ];
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getLink() : string
    {
        return $this->resume;
    }

    public function scopeByUser(Builder $query, int $userId)
    {
        return $query->where('user_id', '=', $userId);
    }

    public function scopeByResume(Builder $query, int $resumeId)
    {
        return $query->where('id', '=', $resumeId);
    }
}
