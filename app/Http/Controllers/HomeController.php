<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::all();
        $posts = Post::with('user')->with('category')->paginate(5);
        return view('home', compact(['categories', 'posts']));
    }

    public function postByCategory($id)
    {
        $categories = Category::all();
        $posts = Post::with('user')->with('category')->where('category_id', $id)->paginate(5);
        return view('home', compact(['categories', 'posts']));
    }
}
