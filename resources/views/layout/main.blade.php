<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css')}}">
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <title>Connect Friend</title>
</head>
<body>
    <div class="container-fluid m-0 p-0 w-100 h-100 bg-success bg-opacity-10">
        @include('component.navbar')
        
        <div>
            @yield('content')
        </div>

        {{-- @include('layout.footer') --}}
    </div>
</body>
</html>