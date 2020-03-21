<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $fillable = [
        'title', 'slug', 'subject', 'user_id'
    ];

    // 1 quote hanya punya 1 user || belongsto adalah kepunyaan
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function isOwner()
    {
        if (Auth::guest()) {
            return false;
        }
        return Auth::user()->id == $this->user_id;
    }
}
