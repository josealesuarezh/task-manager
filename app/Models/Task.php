<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted()
    {
        static::creating(function (Task $task){
            Task::query()
                ->where('priority', '>=', $task->priority)
                ->increment('priority');
        });

        static::updating(function (Task $task) {
            if ($task->isDirty('priority')) {
                $originalPriority = $task->getOriginal('priority');
                $priority = $task->priority;

                if ($priority < $originalPriority) {
                    Task::query()
                        ->where('priority', '>=', $priority)
                        ->where('priority', '<', $originalPriority)
                        ->increment('priority');
                } else {
                    Task::query()
                        ->where('priority', '>=', $originalPriority)
                        ->where('priority', '<=', $priority)
                        ->decrement('priority');
                }
            }
        });

        static::deleting(function (Task $task){
            Task::query()
                ->where('priority', '>=', $task->priority)
                ->decrement('priority');
        });
    }
}
