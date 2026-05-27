<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>支出管理アプリ</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex flex-col min-h-screen">

    <header class="bg-white shadow p-4">
        <nav>
            <h1 class="text-xl font-bold">支出管理アプリ</h1>
        </nav>
    </header>

    <main class="flex-grow container mx-auto p-6">
        {{ $slot }}
    </main>

    <footer class="bg-gray-800 text-white text-center p-4">
        &copy; 2026 Expense Tracker
    </footer>
</body>
</html>