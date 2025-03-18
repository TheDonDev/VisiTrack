<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security Personnel Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h2 class="text-2xl font-bold text-center">Security Personnel Login</h2>
        <form action="{{ route('security.login.submit') }}" method="POST" class="mt-6">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" placeholder="Enter your email">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" placeholder="Enter your password">
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md">Login</button>
        </form>
        <p class="mt-4 text-center">Don't have an account? <a href="{{ route('security.signup') }}" class="text-blue-600">Sign up</a></p>
    </div>
</body>
</html>
