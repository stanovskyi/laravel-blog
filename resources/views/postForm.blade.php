<form method="post"
      action="@if (isset($post) && $post->post_content) {{ route('post.saveEditedPost') }} @else {{ route('post.addPost') }} @endif">
    {{ csrf_field() }}
    @if (isset($post) && $post->id)
        <input type="hidden" name="post_id" value="{{ $post->id }}">
    @endif
    <div class="mb-3">
        <label for="postTitle" class="form-label">Post title</label>
        <input type="text" name="post_title" class="form-control" id="postTitle"
               value="@if (isset($post) && $post->id){{$post->post_title}}@elseif (old('post_title')){{old('post_title')}}@endif" placeholder="Enter post title">
        @if (session('error_post_title'))
            <div class="alert alert-danger">
                {{ session('error_post_title') }}
            </div>
        @endif
    </div>
    <div class="mb-3">
        <label for="postTextArea" class="form-label">Post text</label>
        <textarea style="min-height: 300px;" id="summernote" class="form-control" name="post_content" id="postTextArea"
                  rows="15">@if (isset($post) && $post->id) {{ $post->post_content }}
            @elseif (old('post_content')) {{old('post_content')}} @endif</textarea>
        @if (session('error_post_content'))
            <div class="alert alert-danger">
                {{ session('error_post_content') }}
            </div>
        @endif
    </div>
    <br/>
    <div class="row">
        <div class="col-sm-2">
            <button type="submit" class="btn btn-primary">Save post</button>
        </div>
        @if (isset($post) && $post->id)
            <div class="col-sm-2">
                <a type="submit" href="{{ route('post.getPost', ['id' => $post->id]) }}"
                   class="btn btn-primary">Cancel</a>
            </div>
        @endif
    </div>
</form>

@stack('custom-scripts')

