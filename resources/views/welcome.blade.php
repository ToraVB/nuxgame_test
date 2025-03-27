<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    </head>
    <body class="antialiased">
    <div>
        @if($errors->any())
            {!! implode('', $errors->all('<div>:message</div>')) !!}
            <br>
        @endif
    </div>

        <form action="{{ route('register') }}" method="post">
            @csrf
            <label for="username">
                Username
            </label>
            <input name="username" type="text">
            <br>
            <label for="phonenumber">
                Phonenumber
            </label>
            <input name="phonenumber" type="text">
            <br>
            <button type="submit">
                Register
            </button>
        </form>

        @if(!empty($userLink))
            Your link: {{ route('userLink', ['userLink' => $userLink['link']]) }}
        @endif
    </body>
</html>
