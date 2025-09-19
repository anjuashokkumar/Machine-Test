<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

<div class="bg-white p-8 rounded shadow w-full max-w-md">
    <h1 class="text-2xl font-bold mb-6">Admin Login</h1>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-2 mb-4 rounded">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.login.submit') }}">
        @csrf
        <label class="block mb-2">Email</label>
        <input type="email" name="email" class="w-full p-2 mb-4 border rounded" required>

        <label class="block mb-2">Password</label>
        <input type="password" name="password" class="w-full p-2 mb-4 border rounded" required>

        <button class="bg-blue-500 text-white px-4 py-2 rounded w-full">Login</button>
    </form>
</div>

</body>
</html>
