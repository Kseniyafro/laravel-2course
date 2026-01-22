<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Места хранения</title>
</head>
<body style="font-family: Arial; max-width: 1200px; margin: 0 auto; padding: 20px;">
    <div style="display: flex; justify-content: space-between; margin-bottom: 30px;">
        <h1 style="margin: 0;">Места хранения</h1>
        <a href="{{ route('places.create') }}" 
           style="background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px;">
            Добавить место
        </a>
    </div>

    @if($places->count() > 0)
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
            @foreach($places as $place)
                <div style="border: 1px solid #ddd; padding: 20px; background: white;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <div style="font-weight: bold;">{{ $place->name }}</div>
                        <div>
                            @if($place->repair)
                                <span style="background: #dc3545; color: white; padding: 2px 6px; font-size: 12px; border-radius: 3px;">
                                    Ремонт
                                </span>
                            @endif
                            @if($place->work)
                                <span style="background: #ffc107; color: #000; padding: 2px 6px; font-size: 12px; border-radius: 3px; margin-left: 5px;">
                                    В работе
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div style="color: #666; margin-bottom: 15px;">
                        {{ $place->description ?? 'Нет описания' }}
                    </div>
                    
                    <div style="color: #777; font-size: 14px; margin-bottom: 15px;">
                        Вещей: {{ $place->usages_count ?? $place->usages()->count() }}
                    </div>
                    
                    <div style="display: flex; gap: 10px;">
                        <a href="{{ route('places.show', $place) }}" 
                           style="background: #17a2b8; color: white; padding: 8px 12px; text-decoration: none; border-radius: 4px; flex: 1; text-align: center;">
                            Просмотр
                        </a>
                        
                        <a href="{{ route('places.edit', $place) }}" 
                           style="background: #ffc107; color: #000; padding: 8px 12px; text-decoration: none; border-radius: 4px; flex: 1; text-align: center;">
                            Редактировать
                        </a>
                        
                        <form action="{{ route('places.destroy', $place) }}" method="POST" style="flex: 1;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    style="background: #dc3545; color: white; padding: 8px 12px; border: none; border-radius: 4px; width: 100%; cursor: pointer;"
                                    onclick="return confirm('Удалить это место?')">
                                Удалить
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div style="text-align: center; padding: 40px; border: 1px solid #ddd; background: white;">
            <h3 style="color: #666;">Пока нет мест хранения</h3>
            <a href="{{ route('places.create') }}" 
               style="color: #007bff; text-decoration: none; display: inline-block; margin-top: 15px;">
                Добавить первое место →
            </a>
        </div>
    @endif

    @if($places->hasPages())
        <div style="text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd;">
            @for ($page = 1; $page <= $places->lastPage(); $page++)
                <a href="{{ $places->url($page) }}" 
                   style="display: inline-block; padding: 5px 10px; margin: 0 2px; 
                          background: {{ $places->currentPage() == $page ? '#007bff' : '#f0f0f0' }};
                          color: {{ $places->currentPage() == $page ? 'white' : '#333' }};
                          text-decoration: none; border-radius: 3px;">
                    {{ $page }}
                </a>
            @endfor
        </div>
    @endif
</body>
</html>