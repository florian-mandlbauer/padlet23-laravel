<!DOCTYPE html>
<html lang="de">
    <head>
        <title>Padlet23 - Laravel (Server)</title>
    </head>
    <body>
        <h1>Padlet23 (WEB6_Laravel_Server)</h1>
        <ul>
            @foreach($padlets as $padlet)
                <li>{{$padlet->title}}</li>
            @endforeach
        </ul>

    <p>[Hier wird eine Liste von Padlets gebaut]</p>

    </body>
</html>
