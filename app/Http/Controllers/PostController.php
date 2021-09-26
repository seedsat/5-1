<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Posts;


class PostController extends Controller
{
    // トップページ
    public function index(Request $request)
    {
        $posts = DB::table('posts')
            ->leftJoin('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.id', 'posts.body', 'posts.created_at', 'users.name')
            ->orderBy('posts.id', 'desc')
            ->get();

        return view('post.index', compact('posts'));
    }

    // SNS投稿処理
    public function create(Request $request)
    {
        $this->validate($request, Posts::$rules);

        // Modelをインスタンス化
        $posts = new Posts;
        $form = $request->all(); // POSTされたデータが格納されている
        
        unset($form['_token']); // _tokenを削除

        $posts->fill($form)->save(); // postされたデータを保存

        return redirect('post'); // TOPページにリダイレクト
    }
}
