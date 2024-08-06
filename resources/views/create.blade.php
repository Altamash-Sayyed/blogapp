@include('layouts.app')
@section('content')
<div class="container mt-4 ">
    <form action="/post" method="post">
        @csrf
        @method('post')
        <div class="form-group">
            <label for="exampleFormControlInput1">Title</label>
            <input name="title" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Title..">
            @if($errors->has('title'))
            <p class="text-danger">{{ $errors->first('title') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="exampleFormControlTextarea1">Enter Content</label>
            <textarea name="content" type="text" class="form-control" placeholder="Enter Content.." id="exampleFormControlTextarea1" rows="3"></textarea>
            @if($errors->has('content'))
            <p class="text-danger">{{ $errors->first('content') }}</p>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>