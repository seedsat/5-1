<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;


class PostController extends Controller
{
    // トップページ
    public function index()
    {
        return view('post.index');
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
