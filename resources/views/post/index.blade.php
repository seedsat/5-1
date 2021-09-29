@extends('layouts.app')
@section('title', 'トップページ')

@section('content')
    <div class="container">
        <div class="contents">
            <div class="posts">
                <div class="top">
                    ホーム
                </div>
                <div class="bottom">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ action('PostController@create') }}" method="POST">
                        @csrf <!-- formの中にこの記述を書かなければ【419】エラーが出る -->
                        <input type="text" name="body" class='input' placeholder="いまどうしてる？">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">　<!-- ログインしていなければAuth::user()は使えない -->
                        <input type="submit" value="つぶやく" class="submit alert-success">
                    </form>
                </div>
            </div>
            @foreach ($results as $result)
                <div class="sns">
                    <div class="sns_top">
                        <h5>{{ $result->name }}</h5>
                        <p>{{ $result->created_at->format('Y/m/d H:i') }}</p>
                    </div>
                    <div class="sns_bottom">
                        <p>{{ str_limit($result->body, 100) }}</p>
                        @if ($result->user_id == Auth::user()->id)
                            <span><a href="{{ action('PostController@destroy', ['id' => $result->id]) }}">削除</a></span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection