<!-- Stored in resources/views/layouts/master.blade.php -->
<html>
<head>
    @include('modals.errorModal')
    @include('modals.infoModal')
    <title>App Name - @yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>


@section('sidebar')
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <!-- Links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/profile') }}">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/transactions') }}">Transactions</a>
            </li>
            <li class="nav-item top-right links">
                <form action="{{ route('logout') }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button id="logout" type="submit" class="btn btn-dark">logout</button>
                </form>
            </li>
        </ul>

    </nav>
@show

<div class="container">
    @yield('content')
</div>
</body>

<script>
    //reset the content of the error modal every time is hidden
    $("#errorModal").on("hidden.bs.modal", function () {
        $(".modal-body-1").html("<div id=\"errors\"></div>");
    });

    //reset the content of the info modal every time is hidden
    $("#infoModal").on("hidden.bs.modal", function () {
        $(".modal-body-2").html("<div id=\"message\"></div>");
    });
</script>

</html>
