<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $isNew ? 'Новое описание' : 'Обновление описания' }}</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.5; color: #333; margin: 20px;">
    <h2 style="color: #007bff;">{{ $isNew ? 'Добавлено новое описание' : 'Обновлено описание' }}</h2>
    
    <p><strong>Вещь:</strong> {{ $thing->name }}</p>
    <p><strong>Владелец:</strong> {{ $thing->owner->name }}</p>
    <p><strong>Автор изменения:</strong> {{ $user->name }}</p>
    
    <div style="background: #f5f5f5; padding: 15px; margin: 15px 0; border-left: 3px solid #007bff;">
        {{ $description }}
    </div>
    
    <p><strong>Дата изменения:</strong> {{ now()->format('d.m.Y H:i') }}</p>
    
    <a href="{{ route('things.show', $thing) }}" 
       style="background: #007bff; color: white; padding: 10px 20px; text-decoration: none; display: inline-block;">
        Посмотреть вещь
    </a>
    
    <hr style="margin: 30px 0;">
    <p style="color: #666; font-size: 14px;">Storage of Things</p>
</body>
</html>