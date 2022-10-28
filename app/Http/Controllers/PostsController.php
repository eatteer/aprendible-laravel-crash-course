<?php

namespace App\Http\Controllers;

use App\Http\Requests\SavePostRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $posts = DB::table('posts')->orderByDesc('created_at')->get();
        return view('posts.index', ['posts' => $posts]);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', ['post' => $post]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validInputs = $request->validate([
            'title' => 'required | min:3',
            'body' => 'required | min:10'
        ]);

        // $input = $request->all();

        /*$post = new Post;
        $post->title = $input['title'];
        $post->body = $input['body'];
        $post->save();*/

        // Require protected $fillable = [...fields] in Post model
        /*Post::create([
            'title' => $input['title'],
            'body' => $input['body']
        ]);*/

        Post::create($validInputs);

        session()->flash('postStatus', 'Post created');

        return redirect()->route('posts.index');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit', ['post' => $post]);
    }

    public function update(SavePostRequest $request, $id)
    {
        $validFields = $request->validated();

        // $input = $request->all();

        $post = Post::find($id);

        /*$post->title = $input['title'];
        $post->body = $input['body'];
        $post->save();*/

        /*$post->update([
            'title' => $input['title'],
            'body' => $input['body']
        ]);*/

        $post->update($validFields);

        //session()->flash('updatePostMessageStatus', 'Post updated');

        return redirect()
            ->route('posts.show', $id)
            ->with('postStatus', 'Post updated');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()
            ->route('posts.index')
            ->with('postStatus', 'Post deleted');
    }
}
