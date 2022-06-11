<?php

namespace App\Http\Controllers\API;

use Validator;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{
    //list all posts
    public function posts() {
        $posts = Post::with('user')->get();

        return response()->json([
            'success' => true,
            'message' => $posts
        ], 200);
    }

    //get post by id
    public function post($id) {
        $post = Post::find($id);

        if(is_null($post)) {
            return response()->json([
                'success' => false,
                'message' => 'Post does not exist!'
            ], 500); 
        }

        return response()->json([
            'success' => true,
            'message' => $post
        ], 200);
    }

    //create post
    public function create(Request $request) {
        $validator = Validator::make($request->all(),
        [
            'title' => 'required|string|min:2|max:50',
            'body' => 'required|string|min:2',
            'user_id' => 'required',
        ]);
        
        if($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        
        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = $request->user_id;
        $post->save();

        return response()->json([
            'success' => true,
            'message' => 'Post created successfully!'
        ], 201);

    }

    //update post
    public function edit(Request $request) {
        $validator = Validator::make($request->all(),
        [
            'title' => 'required|string|min:2|max:50',
            'body' => 'required|string|min:2',
            'user_id' => 'required',
            'id' => 'required',
        ]);
        
        if($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $post = Post::find($request->id);

        if(is_null($post)) {
            return response()->json([
                'success' => false,
                'message' => 'Post does not exist!'
            ], 500); 
        }

        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = $request->user_id;
        $post->update();

        return response()->json([
            'success' => true,
            'data' => 'Post updated successfully!'
        ], 201);
        
    }

    //delete post
    public function delete($id) {

        $post = Post::find($id);

        if(is_null($post)) {
            return response()->json([
                'success' => false,
                'message' => 'Post does not exist!'
            ], 500); 
        }

        $post->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post deleted successfully!'
        ], 200);
    }
}
