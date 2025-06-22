<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@2/css/pico.min.css">
</head>
<body class="container">
    <main class="min-vh-100 d-flex justify-center align-center" style="display: flex; align-items: center; justify-content: center; height: 100vh;">
        <article style="max-width: 400px; width: 100%;">
            <h2 class="text-center">Enter Password</h2>
            <form method="POST">
                @csrf
                <input type="password" name="password" placeholder="Password" required>
                @if ($errors->any())
                    <small style="color: red;">{{ $errors->first() }}</small>
                @endif
                <button type="submit" class="contrast">Enter</button>
            </form>
        </article>
    </main>
</body>
</html>
