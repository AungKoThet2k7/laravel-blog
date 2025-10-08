<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $posts = Post::when(request("s"), function ($q) {
            $search = request("s");
            $q->orWhere("title", "like", "%$search%");
            $q->orWhere("description", "like", "%$search%");
        })->latest('id')
            ->with(['category', 'user'])
            ->paginate(10)
            ->withQueryString();
        return view("index", compact("posts"));
    }

    public function detail($slug)
    {
        $post = Post::where("slug", $slug)->with(["category", "user"])->first();
        $recentPosts = Post::latest('id')->limit(5)->get();
        return view("detail", compact("post", "recentPosts"));
    }

    public function postByCategory(Category $category)
    {
        $posts = Post::where(function ($q) {
            $q->when(request("s"), function ($q) {
                $search = request("s");
                $q->orWhere("title", "like", "%$search%");
                $q->orWhere("description", "like", "%$search%");
            });
        })
            ->latest('id')
            ->where("category_id", $category->id)
            ->with(['category', 'user'])
            ->paginate(10)
            ->withQueryString();
        return view("index", compact("posts", "category"));
    }
}
