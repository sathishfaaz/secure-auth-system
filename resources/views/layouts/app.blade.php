<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Welcome')</title> <!-- Page-specific title -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <!-- Bootstrap CSS (If not already included) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">


</head>
<body>


            <!-- Include the header (if you want it in every page) -->
            @include('layouts.header')
            <!-- Main Content -->
            <main>
                @yield('content') <!-- Each page will define its own content -->
            </main>

    <!-- Footer Section -->
    <footer>
        <p>&copy; {{ date('Y') }} Our Company. All rights reserved.</p>
        <ul>
            <li><a href="https://facebook.com/ourcompany" target="_blank">Facebook</a></li>
            <li><a href="https://twitter.com/ourcompany" target="_blank">Twitter</a></li>
            <li><a href="https://linkedin.com/company/ourcompany" target="_blank">LinkedIn</a></li>
        </ul>
    </footer>

</body>
</html>
