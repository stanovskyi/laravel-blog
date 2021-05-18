@include('header')
<main class="container">
    <div class="row">
        <div class="col col-sm-2">@include('leftMenu')</div>
        <div class="col col-sm-10 left-border">
            @include('status')
            <h1>Edit post</h1>
            @include('postForm')
        </div>
    </div>
</main>
@include('footer')
