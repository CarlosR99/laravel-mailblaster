{{-- filepath: MailBlaster/resources/views/emails/templates/imagen.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $campaign->name }}</title>
</head>
<body style="background: #f4f4f4; padding: 40px; text-align: center;">
    <div style="background: #fff; border-radius: 8px; padding: 24px; display: inline-block;">
        <h1>{{ $campaign->name }}</h1>
        @if($campaign->image_path)
            <a href="{{ asset('storage/' . $campaign->image_path) }}" target="_blank">
                <img src="{{ asset('storage/' . $campaign->image_path) }}" alt="Imagen de campaña" style="max-width:100%; border-radius:8px;">
            </a>
        @endif
        <div>
            {!! $campaign->content ?? '' !!}
        </div>
    </div>
</body>
</html>