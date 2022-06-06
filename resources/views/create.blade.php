@extends('layouts.app')

@section('create')
<h2>新規作成</h2>
<div class="create_new">
    <form action="{{ url('/create/new') }}" method="post">
        {{ csrf_field() }}
        <div>
            <select name="category">
                @foreach($Categories as $Category)
                    <option value="{{ $Category->id }}">{{ $Category->name }}</option>
                @endforeach
            </select>
        </div>
        <textarea name="text" id="" cols="30" rows="10"></textarea>
        @foreach ($errors->all() as $error)
            <p class="error_message">{{ $error }}</p>
        @endforeach
        <p><input type="submit" value="新規作成"></p>
        <input type="hidden" name="mode" value="create_new">
        <p><a href="{{ url('/home') }}">homeに戻る</a></p>
    </form>
</div>
@endsection
