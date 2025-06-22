<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Send Call</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@2/css/pico.min.css">
</head>
<body class="container">
    <main class="min-vh-100 d-flex justify-center align-center" style="display: flex; align-items: center; justify-content: center; height: 100vh;">
        <article style="max-width: 500px; width: 100%;">
            <h2 class="text-center">Send Call</h2>

            @if (session('status'))
                <div class="bg-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="/send-call">
                @csrf
                <input type="text" name="number" placeholder="Phone Number" required>
                <input type="text" name="key" value="Gift By DH Alamin" placeholder="Key" required>
                <input type="number" name="limit" placeholder="Limit" required>
                <button type="submit" class="contrast">Send</button>
            </form>
        </article>
    </main>
</body>
</html>
