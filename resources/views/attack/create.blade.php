<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create rotation</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">

</head>
<body>
    
<nav class="top-nav">
    <a href="{{ url('/') }}" class="nav-item highlight">RotationIQ</a>
    <div class="nav-item"><a href="{{ route('defence.index') }}">defence</a></div>
    <div class="nav-item"><a href="{{ route('attack.index') }}">attack</a></div>
    <a href="{{ route('defence.create') }}" class="nav-item highlight">MAKE NEW ROTATION</a>
</nav>





<div id="court">
    <div class="zones">
        <div class="zone">4</div>
        <div class="zone">3</div>
        <div class="zone">2</div>
        <div class="zone">5</div>
        <div class="zone">6</div>
        <div class="zone">1</div>
    </div>
    
    <svg id="lines" width="500" height="400"
     style="position:absolute; top:0; left:0; pointer-events:none;">
    </svg>

    <div class="player" data-pos="4" data-role="RS" style="top:78px; left:61px;">RS</div>
    <div class="player" data-pos="3" data-role="MB" style="top:78px; left:228px;">MB</div>
    <div class="player" data-pos="2" data-role="OH" style="top:78px; left:395px;">OH</div>

    <div class="player" data-pos="5" data-role="OH" style="top:278px; left:61px;">OH</div>
    <div class="player" data-pos="6" data-role="L"  style="top:278px; left:228px;">L</div>
    <div class="player" data-pos="1"  data-role="S" style="top:278px; left:395px;">S</div>

</div>


<button onclick="checkRotationWithVisuals()">Check Rotation</button>

<div class="rotation-type-select">
    <label class="rotation_type" for="rotationType">Rotation type:</label>
    <select id="rotationType" name="rotationType" >
        <option value="attack">attack rotation</option>
    </select>
</div>
<input  type="text" id="rotation-name" placeholder="Rotation Name">
<button onclick="saveRotation()">Save Rotation</button>
<button onclick="rotateClockwise()">Rotate Clockwise ⟳</button>


<script src="{{ asset('script.js') }}"></script>

</body>
</html>