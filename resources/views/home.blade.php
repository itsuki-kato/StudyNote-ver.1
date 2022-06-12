@extends('layouts.app')

@section('sideNav')
    <div class="sideNav">
        <div class="category_nav">
            <button>カテゴリフォルダ</button>
            <button>カテゴリフォルダ</button>
            <button>カテゴリフォルダ</button>
            <button>カテゴリフォルダ</button>
            <button>カテゴリフォルダ</button>
        </div>
    </div>
@endsection @section('content') <div class="container">
    <div class="row justify-content-center">
        <!-- 検索フォーム -->
        <form action="{{ route('home') }}" method="get">
            @csrf
            <div class="header_input_search">
                <input id="search_form" name="keyword" type="text" value="{{ $keyword }}">
                <p><input id="search_btn" type="submit" value="search"></p>
            </div>
        </form>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <span>学習メモ</span>
                    <i class="fa-solid fa-cat" style="color: white;"></i>
                </div>
                <div class="card-body">
                    <!-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif -->
                    <div class="lists_wrapper">
                        <ul>
                            @foreach($Texts as $Text)
                                <div class="list_wrapper">
                                    <li class="list">
                                        <table>
                                            <tr>
                                                @foreach($Categories as $Category)
                                                    @if($Text->category_id == $Category->id)
                                                        <th class="list_item">カテゴリ名</th>
                                                        <td>{{ $Category->name }}</td>
                                                        <!-- 一致した時点でブレークする -->
                                                        @break
                                                    @endif
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <th>タイトル</th>
                                                <td>{{ $Text->title }}</td>
                                            </tr>
                                            <tr>
                                                <th class="list_item">本文</th>
                                                <td>{!! nl2br(e($Text->text)) !!}</td>
                                                <tr class="edit">
                                                    <th></th>
                                                    <td>
                                                        <textarea name="text" id="" cols="30" rows="10">{{ old('description', $Text->text) }}</textarea>
                                                    </td>
                                                </tr>
                                            </tr>
                                        </table>
                                        <tr>
                                            <th></th>
                                            <td>
                                                <div class="button_wrapper">
                                                    <a href="{{ route('edit', ['id' => $Text->id]) }}">
                                                        <button id="edit_btn">編集</button>
                                                    </a>
                                                    <form action="{{ route('delete', ['id' => $Text->id]) }}" method="post">
                                                        <!-- これがないとエラーになる -->
                                                        @method('DELETE')
                                                        @csrf
                                                        <p><button id="delete_btn" type="submit">削除</button></p>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    </li>
                                </div>
                                @endforeach
                                {{ $Texts->appends(request()->query())->links() }}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
