<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    @include('layouts.partials.admin._styles')
</head>
<body>
    @include('layouts.partials.admin._navbar')
    <div class="container-fluid">
        <div class="row">
            @include('layouts.partials.admin._sidebar')

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                @yield('content')
            </main>

        </div>
    </div>
    @include('layouts.templates._categories')
    <!-- Scripts -->
    @include('layouts.partials.admin._scripts')
</body>
</html>
