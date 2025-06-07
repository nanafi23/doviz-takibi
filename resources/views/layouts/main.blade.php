<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Laravel - Curency converter</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet"
    href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css') }}">
  <link href="{{ asset('https://fonts.googleapis.com/css?family=Alegreya+Sans:300,400,700,900') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css') }}">
  <!-- Importing custom CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css.css') }}">
</head>

<body>
  <!-- Section that will be replaced by the content of the child views -->
  @yield('main-section')
</body>

</html>
