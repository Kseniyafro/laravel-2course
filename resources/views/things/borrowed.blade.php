<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Взятые мной вещи</title>
</head>
<body style="font-family: Arial; max-width: 1200px; margin: 0 auto; padding: 20px;">
    <h1 style="border-bottom: 2px solid #17a2b8; padding-bottom: 10px;">
        Взятые мной вещи
    </h1>

    @if($usages->count() > 0)
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; margin: 30px 0;">
            @foreach($usages as $usage)
                <div style="border: 1px solid #ddd; background: white; padding: 20px;">
                    <h3 style="margin: 0 0 15px 0; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                        {{ $usage->thing->name }}
                    </h3>
                    
                    @if($usage->thing->description)
                        <div style="color: #666; margin-bottom: 15px;">
                            {{ Str::limit($usage->thing->description, 100) }}
                        </div>
                    @endif
                    
                    <div style="margin-bottom: 20px;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                            <strong>Владелец:</strong>
                            <span>{{ $usage->thing->owner->name }}</span>
                        </div>
                        
                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                            <strong>Место:</strong>
                            <span>{{ $usage->place->name }}</span>
                        </div>
                        
                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                            <strong>Количество:</strong>
                            <span>{{ $usage->formatted_amount }}</span>
                        </div>
                        
                        <div style="display: flex; justify-content: space-between;">
                            <strong>Взято:</strong>
                            <span>{{ $usage->created_at->format('d.m.Y H:i') }}</span>
                        </div>
                    </div>
                    
                    <div style="text-align: center;">
                        <a href="{{ route('things.show', $usage->thing) }}" 
                           style="background: #17a2b8; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; display: inline-block;">
                            Подробнее
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div style="text-align: center; padding: 40px; border: 1px solid #ddd; background: white; margin: 30px 0;">
            <h3 style="color: #666;">Вы пока не взяли ни одной вещи</h3>
            <p style="color: #666;">Здесь будут отображаться взятые вещи</p>
        </div>
    @endif

    @if($things->hasPages())
        <div style="text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd;">
            @for ($page = 1; $page <= $things->lastPage(); $page++)
                <a href="{{ $things->url($page) }}" 
                   style="display: inline-block; padding: 5px 10px; margin: 0 2px;
                          background: {{ $things->currentPage() == $page ? '#17a2b8' : '#f0f0f0' }};
                          color: {{ $things->currentPage() == $page ? 'white' : '#333' }};
                          text-decoration: none; border: 1px solid #ddd;">
                    {{ $page }}
                </a>
            @endfor
        </div>
    @endif
</body>
</html>