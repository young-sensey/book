<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Get posts
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::query()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return response()
            ->view('posts', ['posts' => $posts], 200);
    }

    /**
     * Create post
     *
     * @param CreatePostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(CreatePostRequest $request)
    {
        $post = new Post();

        $post->user_id = Auth::id();
        $post->text = $request->input('text');
        $post->save();

        return redirect()->route('posts.list')
            ->with('success','Post created successfully!');
    }

    /**
     * Update post
     *
     * @param UpdatePostRequest $request
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);
        $post->text = $request->input('text');
        $post->save();

        return redirect()->route('posts.list')
            ->with('success','Post updated successfully!');
    }

    /**
     * Remove post
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete(Request $request, Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        return redirect()->route('posts.list')
            ->with('success','Post deleted successfully!');
    }
}
