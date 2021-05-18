<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Carbon\Carbon;
use Illuminate\Routing\Redirector;

class BlogController extends Controller
{
    public function index()
    {
        return view('blog', ['posts' => DB::table('posts')->orderBy('id', 'desc')->paginate(4)]);
    }

    public function addPost(Request $request)
    {
        if(!empty($this->validatePostForm($request))){
            return back()->withInput($request->input())
                ->with($this->validatePostForm($request)['status'], $this->validatePostForm($request)['text']);
        }

        if (Schema::hasTable('posts')) {
            $id = DB::table('posts')->insertGetId([
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
        $post = DB::table('posts')->where('id', '=', $id)->first();
        $post->post_title = html_entity_decode($post->post_title, ENT_QUOTES);
        $post->post_content = html_entity_decode($post->post_content, ENT_QUOTES);
        return view('getPost', ['post' => $post]);
    }


    public function removePost($id)
    {
        DB::table('posts')->where('id', '=', $id)->delete();
        return redirect()->route('blog')
            ->with('status', 'Post removed!');
    }

    public function saveEditedPost(Request $request)
    {
        if(!empty($this->validatePostForm($request))){
            return back()->withInput($request->input())
                ->with($this->validatePostForm($request)['status'], $this->validatePostForm($request)['text']);
        }

        DB::table('posts')
            ->where('id', $request->input('post_id'))
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
        return view('editPost', ['post' => DB::table('posts')
            ->where('id', '=', $id)
            ->first()]);
    }

    public function htmlentitiesBlog($str)
    {
        return htmlentities(trim($str), ENT_QUOTES);
    }

    public function validatePostForm($request){
        if (empty($request->input('post_title'))) {
            return $error = [
                'status' => 'error_post_title',
                'text' => 'Enter Post Title'
            ];
        }
        if (empty(strip_tags($request->input('post_content')))) {
            return $error = [
                'status' => 'error_post_content',
                'text' => 'Enter Post Content'
            ];
        }
    }
}
