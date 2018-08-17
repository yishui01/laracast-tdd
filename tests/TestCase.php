<?php

namespace Tests;

use App\Exceptions\Handler;
use Exception;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp()
    {
        parent::setUp();

        $this->disableExceptionHandling();
    }

    protected function SignIn($user = null)
    {
        $user = $user ?: factory('App\Models\User')->create();
        $this->actingAs($user);
        return $this;
    }

    protected function disableExceptionHandling()
    {
        $this->oldExceptionHander = $this->app->make(ExceptionHandler::class);
        $this->app->instance(ExceptionHandler::class, new class extends Handler{
            public function __construct(){}
            public function report(Exception $exception)
            {}
            public function render($request, Exception $exception)
            {
                throw $exception;
            }
        });
    }

    protected function withExceptionHandling()
    {
        $this->app->instance(ExceptionHandler::class, $this->oldExceptionHander);
        return $this;
    }
}
