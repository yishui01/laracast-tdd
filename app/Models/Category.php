<?php

namespace App\Models;

class Category extends Model
{
    public function thread()
    {
        return $this->hasMany(Thread::class);
    }
}
