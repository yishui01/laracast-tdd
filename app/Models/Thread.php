<?php

namespace App\Models;

class Thread extends Model
{
    protected $guarded = []; // 意味所有属性均可更新，后期会修复此安全隐患

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function addReply($reply)
    {
        $this->replies()->create($reply);
    }

    public function path()
    {
        return "/threads/{$this->category->slug}/{$this->id}";
    }

}
