@include('header')
<main class="container">
    <div class="row">
        <div class="col col-sm-2">@include('leftMenu')</div>
        <div class="col col-sm-10 left-border">
            @include('status')
            <h1>Post List</h1>
            @foreach($posts as $post)
                <article class="col-12">
                    <div class="row">
                        <div class="col-sm-10"><h3>{{ $post->post_title }}</h3></div>
                        <div class="date col-sm-2">{{ $post->created_at }}</div>
                    </div>
                    <p>{!! mb_strimwidth(strip_tags(html_entity_decode($post->post_content, ENT_QUOTES)), 0, 350, "...") !!}</p>
                    <a href="{{ route('post.getPost', ['id' => $post->id]) }}" title="Read {{ $post->post_title }}" class="btn btn-primary"><span>Read more</span></a>
                    <a href="{{ route('post.editPost', ['id' => $post->id]) }}" title="Edit {{ $post->post_title }}" class="btn btn-primary"><span>Edit post</span></a>
                    <a href="{{ route('post.removePost', ['id' => $post->id]) }}" title="Remove {{ $post->post_title }}" class="btn btn-primary"><span>Remove post</span></a>
                </article>
            @endforeach
            <div class="d-flex justify-content-center">
                {!! $posts->links() !!}
            </div>
        </div>
    </div>
</main>
@include('footer')
