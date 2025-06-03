<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name', 'user_id'];

    /**
     * Gets a project´s user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Gets a project´s tasks
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
