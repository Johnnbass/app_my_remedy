<html>

<head>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Meu Remédio</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            padding: 20px;
        }

        .navbar {
            margin-bottom: 20px;
        }

    </style>
</head>

<body>
    <div class="container">
        @component('.layout._components.navbar', ['current' => $current])
        @endcomponent
        <main role="main">
            @hasSection('body')
                @yield('body')
            @endif
        </main>
    </div>

    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>

    @hasSection('javascript')
        @yield('javascript')
    @endif
</body>

</html>
