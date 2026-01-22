<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Уведомления</title>
</head>
<body style="font-family: Arial; margin: 20px;">
    <h1 style="border-bottom: 2px solid #007bff; padding-bottom: 10px;">
        Мои уведомления
    </h1>
    
    @if($notifications->count() > 0)
        @foreach($notifications as $notification)
            <div style="border: 1px solid {{ !$notification->read ? '#007bff' : '#ddd' }};
                        margin-bottom: 15px; padding: 15px;">
                <div style="margin-bottom: 10px; font-weight: bold;">
                    {{ $notification->title }}
                    @if(!$notification->read)
                        <span style="background: #007bff; color: white; padding: 2px 8px; font-size: 12px;">
                            Новое
                        </span>
                    @endif
                </div>
                
                <div style="margin-bottom: 10px; color: #555;">
                    {{ $notification->message }}
                </div>
                
                <div style="color: #666; font-size: 14px; margin-bottom: 10px;">
                    От: {{ $notification->fromUser->name }} • 
                    {{ $notification->created_at->format('d.m.Y H:i') }}
                </div>
                
                <a href="{{ route('notifications.show', $notification) }}" 
                   style="color: #007bff; text-decoration: none; float: right;">
                    Подробнее →
                </a>
                
                <div style="clear: both;"></div>
            </div>
        @endforeach
        
        <div style="margin-top: 30px; text-align: center;">
            @for($i = 1; $i <= $notifications->lastPage(); $i++)
                <a href="{{ $notifications->url($i) }}" 
                   style="display: inline-block; padding: 5px 10px; margin: 0 3px;
                          background: {{ $i == $notifications->currentPage() ? '#007bff' : '#f0f0f0' }};
                          color: {{ $i == $notifications->currentPage() ? 'white' : '#333' }};
                          text-decoration: none;">
                    {{ $i }}
                </a>
            @endfor
        </div>
    @else
        <div style="text-align: center; padding: 40px 0; color: #666;">
            Нет уведомлений
        </div>
    @endif
</body>
</html>