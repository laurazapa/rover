<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <title>Mars Rover</title>
    </head>
    <body>
        <div class="p-md-5 p-3">
            <h1 class="bg-dark text-light rounded text-center py-2">Mars Rover</h1>

            <section class="px-md-5 py-3">
                <h3>Instructions:</h3>
                <ul>
                    <li>This planet is 200x200, so the largest coordinate possible is 199. The planet has two obstacles, one at coordinate 8:8 and another one at coordinate 5:2.</li>
                    <li>Write X and Y coordinates.</li>
                    <li>Write the direction the rover is facing (may be N, S, E, W).</li>
                    <li>Write the commands sento to the rover (may be F to move forward and R and L to turn right and left, respectively).</li>
                    <li>Press move to send the data to the rover.</li>
                    <li>The rover will return coordinates as X:Y:D, where D is the direction. If the rover founds an obstacle, it will report it along with the last position reached. If the rover reaches the end of the planet, it wraps to the start.</li>
                </ul>
            </section>

            <form action="{{ route('execute') }}" method="POST" class="p-md-5 p-3 border rounded">
                {{ csrf_field() }}


                <label>Starting X coordinate</label>
                <input class="mb-2" type="number" step="1" min="0" max="199" required name="starting_x" value="{{ old('starting_x')?? '' }}"> 
                
                <br>
                <label>Starting Y coordinate</label>
                <input class="mb-2" type="number" step="1" min="0" max="199" required name="starting_y" value="{{ old('starting_y')?? '' }}">
                
                <br>
                <label>Starting direction</label>
                <input class="mb-2" type="string" maxlength="1" required name="starting_direction" value="{{ old('starting_direction')?? '' }}">
                
                <br>
                <label>Commands</label>
                <input class="mb-2" type="string" required minlength="1" name="commands" value="{{ old('commands')?? '' }}">

                <br>
                <button class="rounded-pill bg-dark text-light py-1 px-4">Move</button>
            </form>
            
            @if($errors->any())
            <div class="alert alert-danger mt-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if (Session::has('result'))
                <div class="alert alert-info mt-4">
                    <span class="me-3">ROVER RESPONSE: </span>{{ Session::get('result') }}
                </div>
            @endif
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    </body>
</html>
