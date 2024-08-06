@include('layouts.app')
@section('content')
    <div class="container m-3">
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-md-6 mb-4">
                    <div class="card mt-3" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post['title'] }}</h5>
                            <p class="card-text">{{ $post['content'] }}</p>
                            <a href="{{ route('posts.show', $post['id']) }}" class="card-link ">
                    View   
                </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
