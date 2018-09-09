<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testCategoryHasManyThread()
    {
        $category = factory('App\Models\Category')->create();
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $category->thread);
    }
}
