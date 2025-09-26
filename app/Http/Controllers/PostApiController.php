<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostApiController extends Controller
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
        return response()->json($posts);
    }

    public function detail($slug)
    {
        $post = Post::where("slug", $slug)->with(["category", "user"])->first();
        return response()->json($post);
    }
}
