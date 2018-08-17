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

    //测试thread与replies的关联关系
   public function testThreadHasReplies()
   {
       //测试$thread->replies能否获取到话题下的评论
       $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
   }

   //测试thread与user的关联关系
   public function testThreadHasCreator()
   {
       $this->assertInstanceOf('App\Models\User', $this->thread->creator);
   }

   //测试thread与category的关联关系
    public function testThreadBelongsToCategory()
    {
        $this->assertInstanceOf('App\Models\Category', $this->thread->category);
    }



}
