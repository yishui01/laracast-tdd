<?php

namespace Tests\Feature;

use App\Models\Thread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadThreads extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testUserCanBrowseThreads()
    {
        $thread = factory('App\Models\Thread')->create();
        $response = $this->get('/threads');
        $response->assertSee($thread->title);
    }

    public function testUserCanReadSingleThread()
    {
        $thread = factory('App\Models\Thread')->create();
        $response = $this->get('/threads/' . $thread->id);
        $response->assertSee($thread->title);
    }
}
