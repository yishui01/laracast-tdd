<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateThreadsTest extends TestCase
{

    use RefreshDatabase;

    //已经登录的用户能够发表帖子,并且发布之后可以看到帖子
    public function testAuthorizedUserCanPublishThread()
    {
        $this->actingAs(factory('App\Models\User')->create()); //已登录用户
        $thread = factory('App\Models\Thread')->make(); //生产一个帖子数据
        $this->post('/threads', $thread->toArray());
        $this->get('/threads')->assertSee($thread->title)->assertSee($thread->body);
    }

    //游客不能发布帖子
    public function testGuestCanNotPublishThread()
    {
        $thread = factory('App\Models\Thread')->make();
        $this->post('/threads',$thread->toArray());
        $this->get('/threads')->assertDontSee($thread->title)->assertDontSee($thread->body);
    }

}
