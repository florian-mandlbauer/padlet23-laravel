<!DOCTYPE html>
<html lang="de">
<head>
    <title>Padlet23 - Laravel (Server)</title>
</head>
<body>
<h1>PADLET-LISTE</h1>
<ul>
    @foreach($padlets as $padlet)
        <li>
            <a href="/padlets/{{$padlet->id}}">{{$padlet->title}}</a>
        </li>
    @endforeach
</ul>
</body>
</html>
