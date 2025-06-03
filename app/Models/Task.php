<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'start_date', 'end_date', 'user_id', 'project_id'];

    /**
     * Gets a task´s user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Gets a task´s project
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
