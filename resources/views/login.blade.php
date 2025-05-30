<!DOCTYPE html>
<html lang="en" class="h-full bg-white">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        @vite('resources/css/app.css')
        <title>{{ config('app.name') }} | Login</title>
    </head>
    <body class="h-full font-inter">
        <x-navbar />
        <div class="flex min-h-full">
        <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:w-96">
            <div>
                <img class="h-10 w-auto" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
                <h2 class="mt-8 text-2xl/9 font-bold tracking-tight text-gray-900">Sign in to your account</h2>
                <p class="mt-2 text-sm/6 text-gray-500">
                Don't have an account?
                <a href="{{ route('register.show') }}" class="font-semibold text-blue-500 hover:text-blue-600">Sign up</a>
                </p>
            </div>

            <div class="mt-10">
                <div>
                <form action="{{ route('login.submit') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                    <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
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

                    <div class="flex items-center justify-between">
                    <div class="flex gap-3">
                        <div class="flex h-6 shrink-0 items-center">
                        <div class="group grid size-4 grid-cols-1">
                            <input id="remember-me" name="remember-me" type="checkbox" value="1" class="col-start-1 row-start-1 appearance-none rounded-sm border border-gray-300 bg-white checked:border-blue-500 checked:bg-blue-500 indeterminate:border-blue-500 indeterminate:bg-blue-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto">
                            <svg class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-disabled:stroke-gray-950/25" viewBox="0 0 14 14" fill="none">
                            <path class="opacity-0 group-has-checked:opacity-100" d="M3 8L6 11L11 3.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path class="opacity-0 group-has-indeterminate:opacity-100" d="M3 7H11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        </div>
                        <label for="remember-me" class="block text-sm/6 text-gray-900">Remember me</label>
                    </div>

                    <div class="text-sm/6">
                        <a href="#" class="font-semibold text-blue-500 hover:text-blue-600">Forgot password?</a>
                    </div>
                    </div>

                    <div>
                    <button type="submit" class="flex w-full justify-center rounded-md bg-gray-900 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-gray-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-800">Sign in</button>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
        <div class="relative hidden w-0 flex-1 lg:block">
            <img class="absolute inset-0 size-full object-cover" src="{{ asset('images/login-side-image.webp') }}" alt="" aria-hidden="true">
            <div class="absolute inset-0 bg-black/20"></div>
        </div>
        </div>
        
        @if ($errors->any())
            <x-notification.validation-errors title="Oops! Something went wrong" :validationMessages="$errors->all()" />
        @endif

        @session ('system')
            <x-notification.system type="success" :message="session('system')" />
        @endsession
    </body>
</html>