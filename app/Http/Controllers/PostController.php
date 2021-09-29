<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Posts;


class PostController extends Controller
{
    // トップページ
    public function index(Request $request)
    {
        $results = Posts::select('posts.id', 'posts.body', 'user_id', 'posts.created_at', 'users.name')
            ->leftJoin('users', 'posts.user_id', '=', 'users.id')
            ->where('deleted_at', '=', null)
            ->orderBy('posts.id', 'desc')
            ->get();

        return view('post.index', compact('results'));
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

        return redirect('/'); // TOPページにリダイレクト
    }

    // SNS削除機能
    public function destroy(Request $request)
    {
        // 送られてきたIDから検索して論理削除
        $post = Posts::find($request->id);

        if(!empty($post))
        {
            if($post->user_id == Auth::user()->id)
            {
                Posts::find($request->id)->delete();
                return redirect('/');
            }
            else
            {
                return redirect(404);
            }
        }
        else
        {
            return redirect(404);
        }
    }
}
