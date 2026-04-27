<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-base-200 flex items-center justify-center p-4">

    <div class="w-full max-w-md bg-base-100 shadow-xl rounded-2xl overflow-hidden">

        <!-- HEADER -->
        <div class="bg-gray-400 text-black p-4 text-center">
            <h1 class="text-xl font-bold">Create New Password</h1>
        </div>

        <!-- FORM -->
        <div class="p-6">

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <label class="form-control w-full mb-3 floating-label">
                    <input type="email" name="email" value="{{ $email ?? '' }}" placeholder="Email"
                        class="input input-bordered w-full peer" required />
                    <span class="label">Email</span>
                </label>

                <label class="form-control w-full mb-3 floating-label">
                    <input type="password" name="password" placeholder="New Password"
                        class="input input-bordered w-full peer" required />
                    <span class="label">New Password</span>
                </label>

                <label class="form-control w-full mb-4 floating-label">
                    <input type="password" name="password_confirmation" placeholder="Confirm Password"
                        class="input input-bordered w-full peer" required />
                    <span class="label">Confirm Password</span>
                </label>

                <button class="btn btn-primary w-full">
                    Reset Password
                </button>

            </form>

        </div>
    </div>

</body>
</html>