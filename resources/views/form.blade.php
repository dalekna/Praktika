<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <title>Forma</title>
</head>
<body>
    <h1>Kontaktinė forma</h1>

    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    <form action="{{ route('submit.form') }}" method="POST">
        @csrf
        <label>Vardas:</label><br>
        <input type="text" name="name" required><br><br>

        <label>El. paštas:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Žinutė:</label><br>
        <textarea name="message" required></textarea><br><br>

        <button type="submit">Siųsti</button>
    </form>
</body>
</html>
