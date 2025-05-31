<!DOCTYPE html>
<html lang="en" class="h-full bg-white">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        @vite('resources/css/app.css')
        <title>{{ config('app.name') }} | Reset Your Password</title>
    </head>
    <body class="h-full font-inter">
        <x-navbar />
        <div class="flex w-5/6 mx-auto items-center h-full">
            <div class="bg-white py-16 sm:py-24 lg:py-32">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <h2 class="max-w-2xl text-3xl font-semibold tracking-tight text-balance text-gray-900 sm:text-4xl">Trouble signing in? Reset your password here</h2>
                <p class="mt-2 text-sm text-gray-600">
                    Enter your email address and we’ll send you a link to reset your password.
                </p>
                <form class="mt-10 max-w-lg" action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="flex gap-x-4">
                    <label for="email" class="sr-only">Email address</label>
                    <input id="email" name="email" type="email" required class="min-w-0 flex-auto rounded-md bg-white px-3.5 py-2 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-300 sm:text-sm/6" placeholder="Enter your email">
                    <button type="submit" class="flex-none rounded-md bg-gray-900 px-3.5 py-2.5 text-sm font-semibold text-white shadow-xs hover:bg-gray-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-800">Send Password Reset Link</button>
                </div>
                <p class="mt-4 text-sm/6 text-gray-900">Remembered your password? <a href="{{ route('login.show') }}" class="font-semibold text-blue-500 hover:text-blue-600">Go back to login</a></p>
                </form>
            </div>
            </div>
        </div>

        @if ($errors->any())
            <x-notification.validation-errors title="Oops! Something went wrong" :validationMessages="$errors->all()" />
        @endif
    </body>
</html>