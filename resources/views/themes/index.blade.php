<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Theme</title>
    <style>
        .theme-card {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 20px;
            text-align: center;
        }

        .theme-card img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <h1>Available Themes</h1>

    <div class="themes">
        @foreach ($themes as $theme)
            <div class="theme-card">
                <img src="{{ $theme['thumbnail_url'] }}" alt="{{ $theme['name'] }} Thumbnail" width="200">
                <h2>{{ $theme['name'] }}</h2>
                <p>{{ $theme['description'] }}</p>
                <p><strong>Author:</strong> {{ $theme['author'] }}</p>
                <p><strong>Version:</strong> {{ $theme['version'] }}</p>
                {{-- <p>{{ $theme['additional_info'] }}</p> --}}

                {{-- @if ($currentTheme == $theme['directory'])
                    <button class="btn btn-success" disabled>Active</button>
                @else
                    <form action="{{ route('admin.themes.activate', $theme['directory']) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Activate</button>
                    </form>
                @endif --}}
            </div>
        @endforeach
    </div>
</body>

</html>
