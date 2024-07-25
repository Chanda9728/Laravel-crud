<!DOCTYPE html>
<html>

<head>
    <title>Laravel CRUD</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .box {
            display: flex;
            justify-content: space-between;
            padding-bottom: 22px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ url('/') }}">Laravel CRUD</a>
    </nav>
    <div class="container mt-5">
        @yield('content')
    </div>
</body>

</html>
