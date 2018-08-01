<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadTest extends TestCase
{
    protected $thread;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->thread = factory('App\Models\Thread')->create();
    }

   public function testThreadHasReplies()
   {
       //测试$thread->replies能否获取到话题下的评论
       $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
   }

   public function testThreadHasCreator()
   {
       $this->assertInstanceOf('App\Models\User', $this->thread->creator);
   }



}
