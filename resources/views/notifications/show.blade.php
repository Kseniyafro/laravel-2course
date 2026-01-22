<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Уведомление</title>
</head>
<body style="font-family: Arial; margin: 20px;">
    <div style="max-width: 800px; margin: 0 auto;">
        <div style="border: 1px solid #ddd; background: white;">
            <div style="padding: 20px; border-bottom: 1px solid #ddd;">
                <h1 style="margin: 0 0 10px 0;">{{ $notification->title }}</h1>
                <div style="color: #666;">{{ $notification->created_at->format('d.m.Y H:i') }}</div>
            </div>
            
            <div style="padding: 20px;">
                <div style="background: #f0f0f0; padding: 15px; margin-bottom: 20px; border-left: 3px solid #007bff;">
                    {{ $notification->message }}
                </div>
                
                <p><strong>От:</strong> {{ $notification->fromUser->name }}</p>
                <p><strong>Вещь:</strong> 
                    <a href="{{ route('things.show', $notification->thing) }}" style="color: #007bff;">
                        {{ $notification->thing->name }}
                    </a>
                </p>
            </div>
            
            <div style="padding: 20px; background: #f8f8f8; border-top: 1px solid #ddd;">
                @if(!$notification->read)
                    <form action="{{ route('notifications.read', $notification) }}" method="POST" id="mark-read-form">
                        @csrf
                        <button type="submit" style="background: #28a745; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">
                            Отметить прочитанным
                        </button>
                        <div style="color: #666; font-size: 14px; margin-top: 5px;">
                            Страница обновится автоматически
                        </div>
                    </form>
                @else
                    <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 4px; margin-bottom: 15px;">
                        <strong>Прочитано:</strong> {{ $notification->read_at->format('d.m.Y в H:i') }}
                    </div>
                @endif
                
                <a href="{{ route('notifications.index') }}" style="color: #007bff; text-decoration: none;">
                    ← Назад к списку
                </a>
            </div>
        </div>
    </div>

    @if(!$notification->read)
    <script>
    document.getElementById('mark-read-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const button = this.querySelector('button');
        const text = button.textContent;
        button.textContent = 'Сохраняем...';
        button.disabled = true;
        
        fetch(this.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(() => {
            location.reload();
        })
        .catch(() => {
            button.textContent = text;
            button.disabled = false;
            alert('Ошибка');
        });
    });
    </script>
    @endif
</body>
</html>