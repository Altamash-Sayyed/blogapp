@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <p class="card-text">{{ $post->content }}</p>
            <p class="card-text">uploaded date: {{ $post->created_at }}</p>
            <p class="card-text">last updated: {{ $post->updated_at }}</p>
        </div>
    </div>
@auth
    @if($auth)
        <!-- Show edit and delete options for the post owner -->
        <div class="mt-4">
            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">Edit</a>
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline" onsubmit="return confirmDelete();">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    @endif
@endauth
    <div class="mt-4">
        <h4>Comments</h4>
        @foreach ($post->comments as $comment)
            <div class="card mt-2">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-muted">{{ $comment->user->name }}</h6>
                    <p class="card-text">{{ $comment->content }}</p>
                </div>
            </div>
        @endforeach

        <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mt-4">
            @csrf
            <div class="form-group">
                <label for="content">Add a Comment</label>
                <textarea name="content" id="content" class="form-control" rows="3" placeholder="Enter your comment..."></textarea>
                @if($errors->has('content'))
                    <p class="text-danger">{{ $errors->first('content') }}</p>
                @endif
            </div>
            <button type="submit" class="btn btn-primary mt-2">Submit</button>
        </form>
    </div>
</div>

<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this post?');
    }
</script>
@endsection
