<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Портал новостей</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('assets/news/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('assets/news/css/blog-home.css')}}" rel="stylesheet">

</head>

<body>
<x-site-header></x-site-header>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            @yield('content')

            <!-- Pagination -->
            <ul class="pagination justify-content-center mb-4">
                <li class="page-item">
                    <a class="page-link" href="#">&larr; Older</a>
                </li>
                <li class="page-item disabled">
                    <a class="page-link" href="#">Newer &rarr;</a>
                </li>
            </ul>
        </div>
        <x-site-sidebar></x-site-sidebar>
    </div>

</div>

<x-site-footer></x-site-footer>

<script src="{{asset('assets/news/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/news/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="https://use.fontawesome.com/9a9ee976fc.js"></script>

</body>

</html>
