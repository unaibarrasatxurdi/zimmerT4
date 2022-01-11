<!DOCTYPE html>
<html lang="en">
    <head>
        @include('components.header')
    </head>
    <body>
        @include('components.nav')
        <div id="app">
            @yield('content')
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <footer>
        @include('components.footer')
        </footer>
    </body>
</html>