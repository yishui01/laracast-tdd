<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Thread $thread, Request $request)
    {
        $this->validate($request,[
            'body' => 'required',
        ]);
        $thread->addReply([
            'body' => request('body'),
            'user_id' => auth()->id(),
        ]);
        return redirect()->route('threads.show', $thread->id)->with('success', '回复成功！');
    }

}
