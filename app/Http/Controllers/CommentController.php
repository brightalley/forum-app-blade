<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentRequest $request)
    {
        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->text = $request->get('text');

        $post = Post::findOrFail($request->get('post_id'));
        $post->comments()->save($comment);

        $comment->setRelation('post', $post);
        $comment->setRelation('user', Auth::user());

        return redirect()->action([PostController::class, 'show'], [$comment->post_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        if ($comment->user_id != Auth::id()) {
            abort(403);
        }

        $comment->delete();

        return redirect()->action([PostController::class, 'show'], [$comment->post_id]);
    }
}
