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
                        <input type="submit" value="つぶやく" class="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection