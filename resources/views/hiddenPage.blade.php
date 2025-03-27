<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{route('userLink.generateLink', ['userLink' => $userLink['link']])}}" method="post">
        @csrf
        <button type="submit">
            Generate new link
        </button>
    </form>
    @if(!empty($newUserLink))
        <br>
        @include('partials.userLink', ['userLink' => $newUserLink])
        <br>
    @endif
    <br>
    <form action="{{route('userLink.deactivateLink', ['userLink' => $userLink['link']])}}" method="post">
        @csrf
        <button type="submit">
            Deactivate current link
        </button>
    </form>
    <br>
    <form action="{{route('userLink.imfeelinglucky', ['userLink' => $userLink['link']])}}" method="post">
        @csrf
        <button type="submit">
            Imfeelinglucky
        </button>
    </form>
    @if(!empty($imfeelinglucky))
        <br>
        Result: {{ $imfeelinglucky['result'] > 0 ? 'Win' : 'Lose' }}. Sum: {{ $imfeelinglucky['result'] }}
        <br>
    @endif
    <br>
    <form>
        <button type="submit">
            History
        </button>
    </form>
</body>
</html>
