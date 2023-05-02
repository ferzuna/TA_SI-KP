<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- untuk css ini di folder public ya -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-DOXMLfHhQkvFFp+rWTZwVlPVqdIhpDVYT9csOnHSgWQWPX0v5MCGtjCJbY6ERspU" crossorigin="anonymous">
    <title>Kerja Praktik - Teknik Komputer</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    @include('layouts.navbar')

    <div>
        @yield('section')
    </div>

    @include('layouts.footer')

</body>

</html>
