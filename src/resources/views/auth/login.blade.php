<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン - Rese</title>
</head>
<body>
    <header style="display: flex; justify-content: space-between; align-items: center; padding: 10px; border-bottom: 1px solid #ccc;">
        <h1>Rese</h1>
    </header>
    <main style="padding: 20px;">
        <h2>ログイン</h2>
        <form action="/login" method="POST">
            @csrf
            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">ログイン</button>
        </form>
    </main>
</body>
</html>