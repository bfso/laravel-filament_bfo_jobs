<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application Test</title>
</head>
<body>
    <h1>Testbewerbung</h1>

    @if (session('status'))
        <p>{{ session('status') }}</p>
    @endif

    <form method="POST" action="/jobs/php-developer/apply">
        @csrf

        <div>
            <label for="name">Name</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}">
        </div>

        <div>
            <label for="email">E-Mail</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}">
        </div>

        <div>
            <label for="phone">Telefon</label>
            <input id="phone" name="phone" type="text" value="{{ old('phone') }}">
        </div>

        <div>
            <label for="cover_letter">Anschreiben</label>
            <textarea id="cover_letter" name="cover_letter" rows="8">{{ old('cover_letter') }}</textarea>
        </div>

        <button type="submit">Bewerbung absenden</button>
    </form>
</body>
</html>
