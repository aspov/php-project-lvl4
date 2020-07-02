<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name','status_id', 'description', 'assigned_to_id'
    ];

    public function creator()
    {
        return $this->belongsTo('App\User');
    }

    public function status()
    {
        return $this->belongsTo('App\TaskStatus');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'task_tag');
    }

    public function assignedTo()
    {
        return $this->belongsTo('App\User', 'assigned_to_id');
    }
}
