<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css')}}">
    @yield('styles')
</head>
<body>
    
    <div class="container">
        @yield('content')
    </div>

    <script src="{{ asset('js/jquery.js') }}">
        
    </script>
    <script src="{{ asset('js/bootstrap.js') }}">
        
    </script>
    @yield('scripts')
    
</body>
</html>