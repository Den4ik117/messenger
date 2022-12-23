<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,1000&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body id="app" class="bg-gray-100 min-h-screen text-gray-800">
    <div class="flex justify-center items-center min-h-screen">
        <div class="grid grid-cols-4 gap-4 max-w-screen-lg w-full">
            @auth
                <div class="col-span-full bg-white rounded p-4 font-semibold text-lg shadow-lg">
                    Вы вошли как {{ auth()->user()->name }}
                </div>
            @endauth

            @guest
                <div class="col-span-full bg-white rounded p-4 font-semibold text-lg shadow-lg">
                    Выберите аккаунт ниже и кликните по нему
                </div>
            @endguest

            @foreach($users as $user)
                <a @class(['bg-white rounded p-2 shadow-lg border hover:bg-gray-50 text-sm overflow-hidden', 'bg-gray-100 text-gray-400 cursor-not-allowed' => auth()->id() === $user->id]) href="{{ route('auth', $user->id) }}">
                    <div class="flex flex-col gap-1">
                        <small>Войти как:</small>
                        <span>{{ $user->name }}</span>
                        <span>{{ $user->email }}</span>
                    </div>
                </a>
            @endforeach

            @auth
                <app :users='@json($users)' :auth='@json(auth()->user())' :msgs='@json($messages)'></app>
            @endauth
        </div>
    </div>
</body>
</html>
