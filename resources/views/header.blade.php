<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow" />
    <title>Laravel blog</title>

    <!-- Fonts -->
    <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet" type="text/css">
    @push('custom-scripts')
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#summernote').summernote({
                    height: 300,
                });
            });
        </script>
    @endpush
    <style>
        body{
            min-height: 100%;
            display: flex;
            flex-direction: column;
        }
        header {
            display: flex !important;
            background: bisque;
            padding: 0.75rem 0 1.45rem 0;
            margin-bottom:2rem;
            height: 10rem;
        }
        footer{
            margin-top: 2rem;
            padding: 1.3rem;
            background: #3a3a3a;
            display: flex;
            height: 10rem;
        }
        main {
            min-height: 500px;
            min-height: calc(100vh - 24rem);
        }
        .left-border{
            border-left: 1px solid #8b8b8b;
        }
        img {
            padding: 10px;
        }
    </style>
</head>
<body>
    <header>
        <span class="text-center col-sm-12 h1"><a href="{{ route('blog') }}">Blog on Laravel header</a></span>
    </header>
