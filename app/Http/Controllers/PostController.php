<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'body'=>'required',
            'image'=>'required'
        ]);
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('image'))
        {
            $imageName ="/img/".$request->file('image')->getClientOriginalName();
            $post->image = $imageName;
        }
        $post->save();
        return redirect()->route('posts.index');

//        $request->validate([
//            'title' => 'required',
//            'body' => 'required',
//            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//        ]);
//
//        if ($image = $request->file('image')) {
//            $destinationPath = 'images/';
//            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
//            $image->move($destinationPath, $profileImage);
//            $input['image'] = "$profileImage";
//            Post::create($request->all());
//        }

    }

    public function edit($id)
    {
        $post = Post::findorFail($id);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request,$id)
    {
        $updateData = $request->validate([
           'title'=>'required',
           'body'=>'required'
        ]);

        Post::whereId($id)->update($updateData);
        return redirect('/post')->with('updated','posts updated');
    }

    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show', compact('post'));
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect('/post')->with('completed', 'posts deleted!');
    }
    public function search(Request $request)
    {
        $search = $request->input('search');

        $posts = Post::query()
            ->where('title','LIKE',"%{$search}%")
            ->orWhere('body','LIKE',"%{$search}%")
            ->get();

        return view('posts.index',compact('posts'));
    }
}
