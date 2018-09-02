<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
class ParticipateInForumTest extends TestCase
{
    use RefreshDatabase;


    //已登录用户可以发表评论
    public function testAuthorizedUserCanPublishReply()
    {
        // Given we have a authenticated user
        // And an existing thread
        // When the user adds a reply to the thread
        // Then their reply should be visible on the page

        $this->signIn();

        $thread = factory('App\Models\Thread')->create();

        $reply = factory('App\Models\Reply')->make(); //这里的make方法只会创建一个实例，不会保存到数据库，create则会保存

        $res = $this->post('/threads/'.$thread->id.'/replies',$reply->toArray());

        $this->get('/threads/'.$thread->id)->assertSee($reply->body);
    }

    //未登录用户发表评论会被重定向到login
    public function testUnauthorizedUserCantPublishReply()
    {
        $this->withExceptionHandling()
            ->post('threads/1/replies',[])
            ->assertRedirect('/login');
    }

    //发表评论body:require验证规则
    public function testReplyRequiresBody()
    {
        $thread = factory('App\Models\Thread')->create();
        $reply = factory('App\Models\Reply')->make(['body'=>null]);
        $this->signIn()->withExceptionHandling()
            ->post('threads/'.$thread->id.'/replies',$reply->toArray())
            ->assertSessionHasErrors('body');
    }
}
