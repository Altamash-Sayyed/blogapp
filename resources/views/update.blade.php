@extends('layouts.app')

@section('content')
<div class="container mt-4 ">
    <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="exampleFormControlInput1">Title</label>
            <input name="title" type="text" value="{{ $post->title }}" class="form-control" id="exampleFormControlInput1" placeholder="Enter Title..">
            @if($errors->has('title'))
                <p class="text-danger">{{ $errors->first('title') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="exampleFormControlTextarea1">Enter Content</label>
            <textarea name="content" class="form-control" placeholder="Enter Content.." id="exampleFormControlTextarea1" rows="3">{{ $post->content }}</textarea>
            @if($errors->has('content'))
                <p class="text-danger">{{ $errors->first('content') }}</p>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
