<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RotationIQ</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>

<nav class="top-nav">
    <a href="{{ url('/') }}" class="nav-item highlight">RotationIQ</a>
    <div class="nav-item"><a href="{{ route('defence.index') }}">defence</a></div>
    <div class="nav-item"><a href="{{ route('attack.index') }}">attack</a></div>
    <a href="{{ route('attack.create') }}" class="nav-item highlight">MAKE NEW ROTATION</a>
</nav>



</body>
</html>