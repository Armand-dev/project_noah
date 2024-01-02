<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    const STATUSES = [
        1 => 'Not started',
        2 => 'In progress',
        3 => 'On hold',
        4 => 'Done',
    ];

    const PRIORITIES = [
        1 => 'High',
        2 => 'Medium',
        3 => 'Low',
    ];

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
