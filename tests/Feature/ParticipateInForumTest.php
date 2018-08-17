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


    public function testAuthorizedUserCanPublishReply()
    {
        // Given we have a authenticated user
        // And an existing thread
        // When the user adds a reply to the thread
        // Then their reply should be visible on the page

        $this->be($user = factory('App\Models\User')->create());

        $thread = factory('App\Models\Thread')->create();

        $reply = factory('App\Models\Reply')->make(); //这里的make方法只会创建一个实例，不会保存到数据库，create则会保存

        $res = $this->post('/threads/'.$thread->id.'/replies',$reply->toArray());

        $this->get('/threads/'.$thread->id)->assertSee($reply->body);
    }

    public function testUnauthorizedUserCantPublishReply()
    {
        //未登录用户无法发表评论,并且会被重定向到登录页
        $thread = factory('App\Models\Thread')->create();
        $reply = factory('App\Models\Reply')->create();
        $this->withExceptionHandling()->post('threads/'.$thread->id.'/replies',$reply->toArray())
            ->assertRedirect('/login');
    }
}
