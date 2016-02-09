<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;

class PostController extends Controller
{
    public function index(Request $request, Post $post)
    {
        $allPosts = $post->whereIn(
            'user_id',
            $request->user()->following()->lists('users.id')->push($request->user()->id)
        )->with('user');

        $posts = $allPosts->orderBy('created_at', 'desc')
            ->take($request->get('limit', 20))
            ->get();

        return response()->json([
            'posts' => $posts,
            'total' => $allPosts->count(),
        ]);
    }

    public function create(Request $request, Post $post)
    {
        $this->validate($request, [
            'body' => 'required|max:140',
        ]);

        $createdPost = $request->user()->posts()->create([
            'body' => $request->body,
        ]);

        return response()->json($post->with('user')->find($createdPost->id));
    }
}
