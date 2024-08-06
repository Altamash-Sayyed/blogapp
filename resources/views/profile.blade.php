@extends('layouts.app')

@section('content')
<div class="container m-3">
    @auth
<h4>{{Auth::user()->name}}</h4>
    @endauth
    <div class="row">
        @foreach ($posts as $post)
        <div class="col-md-6 mb-4">
            <div class="card mt-3" style="width: 100%;">
                <div class="card-body">
                    <h5 class="card-title text-dark">{{ $post['title'] }}</h5>
                    
                    <p class="card-text text-dark">{{ $post['content'] }}</p>
                    <a href="{{ route('posts.show', $post['id']) }}" class="card-link ">
                    View   
                </a>
                    <a href="{{ url('update/' . $post['id']) }}" class="card-link">Update</a>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline" onsubmit="return confirmDelete();">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-link text-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this post?');
    }
</script>
@endsection