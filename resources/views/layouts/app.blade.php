<!doctype html>
<html>
    <head>
        @include('includes.head')
    </head>

    <body>
        <div class="wrap">
            @include('includes.header')

            <div>
                @yield('content')
            </div>

        </div>
        
        <footer>
            @include('includes.footer')
        </footer>
    </body>
</html>