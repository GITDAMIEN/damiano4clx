<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>clxProject</title>
    <link rel="shortcut icon" href="{{ asset('images/clxLogo.png') }}" alt="clxLogo" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<header>
    <div class="row justify-content-center">
        <img style="width: 120px;" src="{{ asset('images/clxLogo.png') }}" alt="clxLogo">
    </div>
</header>

<body>
    {{ $slot }}
</body>

</html>
