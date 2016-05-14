<!DOCTYPE html>
<html>
<head>
    <title>Shakuni Rice Mills</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="{{URL::to('src/css/main.css')}}">
    @yield('style')

</head>
<body>
@include('includes.header')
<div class="container">
@yield('content')

</div>
</body>
</html>