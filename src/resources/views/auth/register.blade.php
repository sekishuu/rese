<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員登録 - Rese</title>
</head>
<body>
    <header style="display: flex; justify-content: space-between; align-items: center; padding: 10px; border-bottom: 1px solid #ccc;">
        <h1>Rese</h1>
    </header>
    <main style="padding: 20px;">
        <h2>会員登録</h2>
        <form action="/register" method="POST">
            @csrf
            <div>
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" required>
                @error('username')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                @error('password')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
            <button type="submit">登録</button>
        </form>
    </main>
</body>
</html>

