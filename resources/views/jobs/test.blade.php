<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Demo</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            color: #222;
            background: #f7f7f7;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 24px;
        }

        .box {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        h1, h2, h3 {
            margin-top: 0;
        }

        ul {
            padding-left: 20px;
        }

        .job-card {
            border-top: 1px solid #eee;
            padding-top: 12px;
            margin-top: 12px;
        }

        .status {
            background: #e8f6ea;
            border: 1px solid #b7dfbe;
            padding: 12px;
            margin-bottom: 16px;
        }

        .errors {
            background: #fdeaea;
            border: 1px solid #efb3b3;
            padding: 12px;
            margin-bottom: 16px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input,
        select,
        textarea,
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 14px;
        }

        textarea {
            min-height: 120px;
        }

        code,
        pre {
            background: #f0f0f0;
            padding: 2px 6px;
            border-radius: 4px;
        }

        pre {
            padding: 12px;
            overflow-x: auto;
        }

        @media (min-width: 768px) {
            .two-cols {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="box">
            <h1>Job Platform Demo</h1>
            <p>Diese Seite zeigt nur die Hauptfunktionen des Projekts.</p>
            <ul>
                <li>Jobs kommen aus der Datenbank.</li>
                <li>Bewerbungen laufen über Web und API.</li>
                <li>Bewerbungen werden als JSON im Storage gespeichert.</li>
            </ul>
        </div>

        <div class="two-cols">
            <div class="box">
                <h2>Verfügbare Jobs</h2>
                @forelse ($jobs as $job)
                    <div class="job-card">
                        <h3>{{ $job->title }}</h3>
                        <p><strong>Company:</strong> {{ $job->company?->company_name ?? 'Unbekannt' }}</p>
                        <p><strong>Kategorie:</strong> {{ $job->category?->name ?? 'Unbekannt' }}</p>
                        <p><strong>Standort:</strong> {{ $job->location?->name ?? 'Unbekannt' }}</p>
                        <p><strong>Slug:</strong> <code>{{ $job->slug }}</code></p>
                    </div>
                @empty
                    <p>Keine Jobs vorhanden.</p>
                @endforelse
            </div>

            <div class="box" id="apply">
                <h2>Bewerbung absenden</h2>

                @if ($jobs->isEmpty())
                    <p>Bitte zuerst Jobs anlegen oder seeden.</p>
                @else
                    @if (session('status'))
                        <div class="status">{{ session('status') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="errors">
                            Formularfehler:
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="/jobs/{{ old('job', $featuredJob?->slug ?? 'php-developer') }}/apply" id="application-form">
                        @csrf

                        <label for="job">Job</label>
                        <select id="job" name="job" onchange="setJob(this.value)">
                            @foreach ($jobs as $job)
                                <option value="{{ $job->slug }}" @selected(old('job', $featuredJob?->slug) === $job->slug)>
                                    {{ $job->title }}
                                </option>
                            @endforeach
                        </select>

                        <label for="name">Name</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}">

                        <label for="email">E-Mail</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}">

                        <label for="phone">Telefon</label>
                        <input id="phone" name="phone" type="text" value="{{ old('phone') }}">

                        <label for="cover_letter">Anschreiben</label>
                        <textarea id="cover_letter" name="cover_letter">{{ old('cover_letter') }}</textarea>

                        <button type="submit">Bewerbung speichern</button>
                    </form>
                @endif
            </div>
        </div>

        <div class="box">
            <h2>API und Storage</h2>
            <p><strong>API-Route:</strong> <code>/api/jobs/{{ $featuredJob?->slug ?? 'php-developer' }}/apply</code></p>
            <p><strong>Storage:</strong> <code>storage/app/private/job-applications/{{ $featuredJob?->slug ?? 'job-slug' }}/</code></p>
            <pre><code>Invoke-RestMethod -Method Post `
  -Uri http://127.0.0.1:8000/api/jobs/{{ $featuredJob?->slug ?? 'php-developer' }}/apply `
  -ContentType 'application/json' `
  -Body '{"name":"Max","email":"max@example.com","cover_letter":"Ich bewerbe mich."}'</code></pre>
        </div>
    </div>

    <script>
        function setJob(slug) {
            const form = document.getElementById('application-form');
            const select = document.getElementById('job');

            if (select && select.value !== slug) {
                select.value = slug;
            }

            if (form) {
                form.action = `/jobs/${slug}/apply`;
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const select = document.getElementById('job');

            if (select) {
                setJob(select.value);
            }
        });
    </script>
</body>
</html>
