@include('header')
<main class="container">
    <div class="row">
        <div class="col col-sm-2">@include('leftMenu')</div>
        <div class="col col-sm-10 left-border">
            @include('status')
            <div class="row">
                <div class="col-sm-2"><a role="button" href="{{ route('post.editPost', ['id' => $post->id]) }}" class="btn btn-primary">Edit Post</a></div>
                <div class="col-sm-2"><a role="button" href="{{ route('post.removePost', ['id' => $post->id]) }}" class="btn btn-primary">Remove Post</a></div>
            </div>
            <article>
                <h1>{{ $post->post_title }}</h1>
                {!! $post->post_content  !!}
            </article>
        </div>
    </div>
</main>
@include('footer')
