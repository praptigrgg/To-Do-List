<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDoList @yield('title')</title>

    <link rel="icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    @yield('styles')
</head>

<body>

    @include('components.navbar')
    <main>
        <div class="container mt-4">

            @yield('content')

        </div>
    </main>

    @include('components.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')

</body>

</html>
