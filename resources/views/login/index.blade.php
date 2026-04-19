<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rhaw Moto Shop</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-base-200 flex items-center justify-center p-4">

    <div class="w-full max-w-md bg-base-100 shadow-xl rounded-2xl overflow-hidden flex flex-col">

        <!-- SMALL TOP HEADER -->
        <div class="w-full bg-gray-400 text-black flex items-center justify-center p-4 sm:p-5 gap-3">

            <!-- Logo (left side) -->
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-12 sm:w-16">

            <!-- Text (right side of logo) -->
            <div class="flex flex-col items-start">
                <h1 class="text-xl sm:text-2xl font-bold leading-tight">
                    Rhaw Moto Shop
                </h1>

                <p class="text-xs sm:text-sm opacity-80">
                    Motorcycle parts & services
                </p>
            </div>

        </div>

        <!-- LOGIN FORM -->
        <div class="w-full p-5 sm:p-6">
            <form method="POST" action="{{ route('loginPost') }}">
                @csrf

                <fieldset class="fieldset">

                    <legend class="fieldset-legend text-lg sm:text-xl font-bold mb-4 text-center">
                        Login
                    </legend>

                    <!-- Username -->
                    <label class="form-control w-full mb-3 floating-label">
                        <input type="text" name="username" placeholder="Username"
                            class="input input-bordered w-full peer focus:outline-none" />
                        <span class="label">Username</span>
                    </label>

                    <!-- Password -->
                    <label class="form-control w-full mb-4 floating-label">
                        <input type="password" name="password" placeholder="Password"
                            class="input input-bordered w-full peer focus:outline-none" />
                        <span class="label">Password</span>
                    </label>

                    <button type="submit" class="btn btn-primary w-full">
                        Login
                    </button>

                </fieldset>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            @if (session('success'))
                Toast.fire({
                    icon: 'success',
                    title: @json(session('success'))
                })
            @endif

            @if (session('error'))
                Toast.fire({
                    icon: 'error',
                    title: @json(session('error'))
                })
            @endif

            @if (session('warning'))
                Toast.fire({
                    icon: 'warning',
                    title: @json(session('warning'))
                })
            @endif

            @if (session('info'))
                Toast.fire({
                    icon: 'info',
                    title: @json(session('info'))
                })
            @endif

            @if (session('question'))
                Toast.fire({
                    icon: 'question',
                    title: @json(session('question'))
                })
            @endif

            @foreach ($errors->all() as $error)
                Toast.fire({
                    icon: 'warning',
                    title: @json($error)
                })
            @endforeach
        });
    </script>

</body>

</html>
