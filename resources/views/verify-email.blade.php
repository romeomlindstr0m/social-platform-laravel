<!DOCTYPE html>
<html lang="en" class="h-full bg-white">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        @vite('resources/css/app.css')
        <title>{{ config('app.name') }} | Verify your email</title>
    </head>
    <body class="h-full font-inter">
        @session ('verification_sent')
            <x-notification.banner :message="session('verification_sent')" />
        @endsession

        <div class="mx-auto flex flex-col w-5/6 lg:w-1/3 h-full justify-center items-center text-center">
            <h1 class="text-4xl font-bold">Just One More Step!</h1>
            <p class="text-wrap text-gray-700 mt-4">
                We’ve sent a verification link to the email address
                <span class="text-blue-500">{{ auth()->user()->email }}</span>
                <br>
                Please click the link to activate your account.
                Didn’t get it? You can request a new one below.
            </p>
            <form class="flex w-4/5" action="{{ route('verification.send') }}" method="POST">
                @csrf
                <button type="submit" class="flex w-full justify-center rounded-md bg-gray-900 px-3 py-2 text-sm/6 font-semibold text-white shadow-xs hover:bg-gray-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-800 mt-4">Resend verification email</button>
            </form>
        </div>
    </body>
</html>