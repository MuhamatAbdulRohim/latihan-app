<!DOCTYPE html>
<html>
<head>
    <title>Caesar Cipher App</title>
</head>
<body>

<h2>Caesar Cipher - Laravel</h2>

<form action="/caesar-process" method="POST">
    @csrf

    <label>Text:</label><br>
    <textarea name="text" required></textarea><br><br>

    <label>Shift:</label><br>
    <input type="number" name="shift" min="1" max="25" required><br><br>

    <label>Mode:</label><br>
    <select name="mode">
        <option value="encrypt">Encrypt</option>
        <option value="decrypt">Decrypt</option>
    </select><br><br>

    <button type="submit">Proses</button>
</form>

@if(session('result'))
    <h3>Hasil:</h3>
    <p>{{ session('result') }}</p>
@endif

</body>
</html>
