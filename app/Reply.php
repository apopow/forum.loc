<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reply extends Model
{
    use Favoritable;

    protected $touches = ['thread'];    

    protected $guarded = [];

    protected $with = ['owner', 'favorites'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function thread()
    {
        return $this->belongsTo('App\Thread');
    }

    public function path()
    {
        return $this->thread->path() . "#reply-{$this->id}";
    }

    public function users()
    {
        return $this->hasManyThrough('App\User', 'App\Sign');
    }
    public function wasJustPublished()
    {
        return $this->created_at->gt(Carbon::now()->subMinute());
    }  
}
