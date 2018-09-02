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
        $this->signIn(); //已登录用户
        $thread = factory('App\Models\Thread')->make(); //生产一个帖子数据
        $response = $this->post('/threads', $thread->toArray());
        $this->get($response->headers->get('Location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    //游客发布帖子时会抛出未授权异常
    public function testGuestsMayNotCreateThread()
    {
        $this->withExceptionHandling()
            ->post('/threads',[])
            ->assertRedirect('/login');
    }

    //游客发布帖子时会被重定向到登陆页面
    public function testGuestsMayNotSeeTheCreateThreadPage()
    {
        $this->withExceptionHandling() //调用这个方法不抛出异常，否则抛出unauthorized异常
            ->get('/threads/create')
            ->assertRedirect('/login');
    }

    //测试表单验证，titile:required
    public function testThreadRequiresTitle()
    {
        $this->publishThread(['title'=>null])
            ->assertSessionHasErrors('title');
    }

    //测试表单验证，body:required
    public function testThreadRequiresBody()
    {
        $this->publishThread(['body' => null])
            ->assertSessionHasErrors('body');
    }

    //测试category的验证规则
    public function testThreadRequiresCategoryId()
    {
        factory('App\Models\Category',2)->create(); // 新建两个 Channel，id 分别为 1 跟 2
        $this->publishThread(['category_id'=>null])
            ->assertSessionHasErrors('category_id');
        $this->publishThread(['category_id' => 999])  // channle_id 为 999，是一个不存在的 Channel
        ->assertSessionHasErrors('category_id');
    }

    //封装方法，用于发表话题
    public function publishThread($overrides)
    {
        $this->withExceptionHandling()->signIn();
        $thread = factory('App\Models\Thread')->make($overrides);
        return $this->post('/threads', $thread->toArray());
    }


}
