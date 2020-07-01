<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function posts()
    {
        $posts = Post::with('user')
            ->with('category')
            ->where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        return view('posts', compact('posts'));
    }
    public function users()
    {
        $users = User::paginate(10);
        return view('users', compact('users'));
    }
}
