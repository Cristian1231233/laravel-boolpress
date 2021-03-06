<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Tag;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(5);
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.index', compact('posts', 'categories', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                'title'=>'required|max:255|min:2',
                'content'=>'required'
            ],
            [
                'title.required'=>'Il titolo è un campo obbligatorio',
                'title.max'=>'Il titolo deve essere lungo massimo :max caratteri',
                'title.min'=>'Il titolo deve essere lungo minimo :min caratteri',
                'content.required'=>'Il testo è un campo obbligatorio'
            ]
        );

        

        $posts = $request->all();
        $new_post = new Post();
        $new_post->fill($posts);
        $new_post->slug = Post::generateSlug($new_post->title);
        $new_post->save();

        if(array_key_exists('tag', $posts)){
            $new_post->tags()->attach($posts['tags']);
        }

        return redirect()->route('admin.posts.show', $new_post);
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
        $tags =Tag::all();
        if($post){
            return view('admin.posts.show', compact('post', 'tags'));
        }
        abort(404, 'Errore nella ricerca del post');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $post = Post::find($id);
        $tags = Tag::all();
        
        if($post){
            return view('admin.posts.edit', compact('post', 'categories', 'tags'));
        }
        abort(404, 'Errore nella ricerca del post');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate(
            [
                'title'=>'required|max:255|min:2',
                'content'=>'required'
            ],
            [
                'title.required'=>'Il titolo è un campo obbligatorio',
                'title.max'=>'Il titolo deve essere lungo massimo :max caratteri',
                'title.min'=>'Il titolo deve essere lungo minimo :min caratteri',
                'content.required'=>'Il testo è un campo obbligatorio'
            ]
        );

        $form_data = $request->all();
        if($form_data['title'] != $post->title){
            $post['slug'] = Post::generateSlug($form_data['title']);
        }
    
        $post->update($form_data);

        if(array_key_exists('tags', $form_data)){
            $post->tags()->attach($form_data['tags']);
        }

        return redirect()->route('admin.posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('delete', 'Post eliminato correttamente');
    }
}
