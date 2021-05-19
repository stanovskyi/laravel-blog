<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Carbon\Carbon;
use Illuminate\Routing\Redirector;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        return view('blog', ['posts' => Blog::orderBy('id', 'desc')->paginate(4)]);
    }

    public function addPost(PostRequest $request)
    {
        if (Schema::hasTable('posts')) {
            $id = Blog::insertGetId([
                'post_title' => $this->htmlentitiesBlog($request->input('post_title')),
                'post_content' => $this->htmlentitiesBlog($request->input('post_content')),
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now()
            ]);
            return redirect()->route('post.getPost', ['id' => $id])
                ->with('status', 'Post added!');
        } else {
            return redirect()->route('post.addPostPage')
                ->with('status', 'Post added!');
        }
    }

    public function getPost($id)
    {
        $post = Blog::where('id', '=', $id)->first();
        $post->post_title = html_entity_decode($post->post_title, ENT_QUOTES);
        $post->post_content = html_entity_decode($post->post_content, ENT_QUOTES);
        return view('getPost', ['post' => $post]);
    }


    public function removePost($id)
    {
        Blog::where('id', '=', $id)->delete();
        return redirect()->route('blog')
            ->with('status', 'Post removed!');
    }

    public function saveEditedPost(PostRequest $request)
    {
        Blog::where('id', $request->input('post_id'))
            ->update([
                'post_title' => $this->htmlentitiesBlog($request->input('post_title')),
                'post_content' => $this->htmlentitiesBlog($request->input('post_content')),
                'updated_at' => Carbon::now()
            ]);
        return redirect()->route('post.getPost', ['id' => $request->input('post_id')])
            ->with('status', 'Post edited!');
    }

    public function editPost($id)
    {
        return view('editPost', ['post' => Blog::where('id', '=', $id)
            ->first()]);
    }

    public function htmlentitiesBlog($str)
    {
        return htmlentities(trim($str), ENT_QUOTES);
    }
}
