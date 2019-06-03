<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use Carbon\Carbon;
use App\Http\Resources\Post as PostResource;

use DB;
use Illuminate\Database\Eloquent\Model;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        // $posts = Post::all();
        // $posts = DB::select('SELECT * FROM posts');
        //$posts = Post::where('title', 'Hello world')->get();
        //$posts = Post::orderBy('title', 'asc')->take(5)->get();
        // $posts = Post::orderBy('title', 'asc')->get();
        $posts = Post::orderBy('title', 'asc')->paginate(3);
        return view('posts.index')->with('posts', $posts);
        
    }

    public function indexApi()
    {

        // $posts = Post::all();
        // $posts = DB::select('SELECT * FROM posts');
        //$posts = Post::where('title', 'Hello world')->get();
        //$posts = Post::orderBy('title', 'asc')->take(5)->get();
        // $posts = Post::orderBy('title', 'asc')->get();
        $posts = Post::all();
        return PostResource::collection($posts);
        
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $categories = Category::all();
        
        
        return view('posts.create')->with('categories', $categories);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);
        
        $post = new Post;
        $post->user_id = auth()->id();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();

        return redirect('/posts')->with('success', 'Post Created');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    public function showApi($id)
    {
        $post = Post::findOrFail($id);
        return new PostResource($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);
        
        $post = Post::find($id);

        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();

        return redirect('/posts')->with('success', 'Post Update');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect('/posts')->with('success', 'Post removed');
    }
}
