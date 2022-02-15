<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Dotenv\Result\Success;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $posts = Post::with(['category','tags'])->paginate(5);
        $categories = Category::all();
        $tags = Tag::all();

        return response()->json(compact('posts', 'categories', 'tags'));
    }

    public function show($slug){
        $posts = Post::where('slug', $slug)->with(['category', 'tags'])->first();
        if(!$posts){
            $posts = ['title' => 'Post non trovato', 'content' => ''];
        }
        return response()->json($posts);
    }

    public function getPostsByCategory($slug_category){
        $category = Category::where('slug', $slug_category)->with('posts.tags')->first();
        $success = true;
        $error = '';
        if(!$category){
            $success = false;
            $error = 'Categoria inesistente';
        }elseif($category && count($category['posts']) === 0){
            $success = false;
            $error = 'Non esistono post per quasta categoria';
        }
        return response()->json(compact('category', 'success', 'error'));
    }

    public function getPostsByTag($slug_tag){
        $tag = Tag::where('slug', $slug_tag)->with('posts.category')->first();
        $success = true;
        $error = '';
        if(!$tag){
            $success = false;
            $error = 'Tag inesistente';   
        }elseif($tag && count($tag['posts']) === 0){
            $success = false;
            $error = 'Non esistono post per quasti tag';
        }

        return response()->json(compact('tag', 'success', 'error'));
    }

}
