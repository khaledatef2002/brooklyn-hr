<!doctype html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
    @include('front.partials._head')
    <body>
        
        @yield('content')

        @include('front.partials._jslibs')
    </body>

</html>