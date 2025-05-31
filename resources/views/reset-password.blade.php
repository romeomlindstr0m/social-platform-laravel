<!DOCTYPE html>
<html lang="en" class="h-full bg-white">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        @vite('resources/css/app.css')
        <title>{{ config('app.name') }} | Set a New Password</title>
    </head>
    <body class="h-full font-inter">
        <x-navbar />
        <div class="flex w-5/6 mx-auto items-center h-full">
            <div class="bg-white py-16 sm:py-24 lg:py-32">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <h2 class="max-w-2xl text-3xl font-semibold tracking-tight text-balance text-gray-900 sm:text-4xl">Choose a new password for your account</h2>
                <p class="mt-2 text-sm text-gray-600">
                    Enter your current email and new password below to finish resetting your account.
                </p>
                <form class="mt-10 max-w-md flex flex-col gap-y-5" action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm/6 font-medium text-gray-900">Email</label>
                        <div class="mt-2">
                            <input type="email" name="email" id="email" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-300 sm:text-sm/6">
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
                        <div class="mt-2">
                            <input type="password" name="password" id="password" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-300 sm:text-sm/6">
                        </div>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm/6 font-medium text-gray-900">Confirm Password</label>
                        <div class="mt-2">
                            <input type="password" name="password_confirmation" id="password_confirmation" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-300 sm:text-sm/6">
                        </div>
                    </div>

                    <input type="hidden" id="token" name="token" value="{{ $token }}">

                    <div>
                        <button type="submit" class="flex w-full justify-center rounded-md bg-gray-900 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-gray-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-800">Reset Password</button>
                    </div>
                </form>
            </div>
            </div>
        </div>

        @if ($errors->any())
            <x-notification.validation-errors title="Oops! Something went wrong" :validationMessages="$errors->all()" />
        @endif
        
        @session('status')
            <x-notification.system type="success" :message="session('status')" />
        @endsession
    </body>
</html>