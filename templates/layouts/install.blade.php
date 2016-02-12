<!DOCTYPE html>
<html>
<head>
    <base href="/webroot">
    <link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css" integrity="sha384-mMG3CP9nPLZ1JW4y6ikjxNX15A0nEt+JQkm/LL6QtYxyXdUV6HG530PFmcJw7cpU" crossorigin="anonymous">
    <script src="http://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script src="@webroot('js/tether.js')"></script>
    <script src="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/js/bootstrap.js" integrity="sha384-3ArYxhJWn9gHczBA3odi4jNRkXeaz+NL175Z8dlM2MlX07U3xg+E/d/Q2RpArfgN" crossorigin="anonymous"></script>
</head>
<body>
    <h1>@yield('title')</h1>
    <hr>
    @yield('content')
</body>
</html>
