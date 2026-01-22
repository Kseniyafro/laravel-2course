<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Место: {{ $place->name }}</title>
</head>
<body style="font-family: Arial; max-width: 1200px; margin: 0 auto; padding: 20px;">
    <div style="display: flex; gap: 20px; flex-wrap: wrap;">
        <!-- Основной контент -->
        <div style="flex: 2; min-width: 300px;">
            <div style="border: 1px solid #ddd; background: white; margin-bottom: 20px;">
                <div style="padding: 20px; background: #f8f8f8; border-bottom: 1px solid #ddd;">
                    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                        <h1 style="margin: 0;">{{ $place->name }}</h1>
                        <div>
                            @if($place->repair)
                                <span style="background: #dc3545; color: white; padding: 5px 10px; border-radius: 4px; font-size: 14px;">
                                    Ремонт/мойка
                                </span>
                            @endif
                            @if($place->work)
                                <span style="background: #ffc107; color: #000; padding: 5px 10px; border-radius: 4px; font-size: 14px; margin-left: 5px;">
                                    В работе
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div style="padding: 20px;">
                    <h3>Описание</h3>
                    <div style="color: #666; margin-bottom: 20px;">
                        {{ $place->description ?? 'Нет описания' }}
                    </div>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                        <div>
                            <h3>Статистика</h3>
                            <div style="background: #f8f9fa; padding: 15px; border-radius: 4px;">
                                <div style="margin-bottom: 10px;">
                                    <strong>Вещей в хранении:</strong> {{ $place->usages()->count() }}
                                </div>
                                <div style="margin-bottom: 10px;">
                                    <strong>Создано:</strong> {{ $place->created_at->format('d.m.Y') }}
                                </div>
                                <div>
                                    <strong>Обновлено:</strong> {{ $place->updated_at->format('d.m.Y') }}
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <h3>Статус</h3>
                            <div style="background: #f8f9fa; padding: 15px; border-radius: 4px;">
                                <div style="margin-bottom: 10px;">
                                    <strong>Ремонт/мойка:</strong> {{ $place->repair ? 'Да' : 'Нет' }}
                                </div>
                                <div style="margin-bottom: 10px;">
                                    <strong>В работе:</strong> {{ $place->work ? 'Да' : 'Нет' }}
                                </div>
                                <div>
                                    <strong>Доступность:</strong> {{ $place->isAvailable() ? 'Доступно' : 'Недоступно' }}
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div style="display: flex; gap: 10px; padding-top: 20px; border-top: 1px solid #ddd;">
                        <a href="{{ route('places.index') }}" 
                           style="background: #6c757d; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px;">
                            Назад к списку
                        </a>
                        
                        @can('update', $place)
                        <a href="{{ route('places.edit', $place) }}" 
                           style="background: #ffc107; color: #000; padding: 10px 20px; text-decoration: none; border-radius: 4px;">
                            Редактировать
                        </a>
                        @endcan
                    </div>
                </div>
            </div>
            
            @if($place->usages()->count() > 0)
            <div style="border: 1px solid #ddd; background: white;">
                <div style="padding: 20px; background: #f8f8f8; border-bottom: 1px solid #ddd;">
                    <h2 style="margin: 0;">Вещи в этом месте</h2>
                </div>
                
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background: #f8f9fa;">
                                <th style="padding: 12px; text-align: left; border-bottom: 2px solid #ddd;">Вещь</th>
                                <th style="padding: 12px; text-align: left; border-bottom: 2px solid #ddd;">Владелец</th>
                                <th style="padding: 12px; text-align: left; border-bottom: 2px solid #ddd;">Пользователь</th>
                                <th style="padding: 12px; text-align: left; border-bottom: 2px solid #ddd;">Количество</th>
                                <th style="padding: 12px; text-align: left; border-bottom: 2px solid #ddd;">Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($place->usages as $usage)
                            <tr style="border-bottom: 1px solid #eee;">
                                <td style="padding: 12px;">{{ $usage->thing->name }}</td>
                                <td style="padding: 12px;">{{ $usage->thing->owner->name }}</td>
                                <td style="padding: 12px;">{{ $usage->user->name }}</td>
                                <td style="padding: 12px;">{{ $usage->formatted_amount }}</td>
                                <td style="padding: 12px;">
                                    <a href="{{ route('things.show', $usage->thing) }}" style="color: #007bff; text-decoration: none;">
                                        Смотреть
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
        
        <!-- Боковая панель -->
        <div style="flex: 1; min-width: 250px;">
            <div style="border: 1px solid #ddd; background: white;">
                <div style="padding: 20px; background: #f8f8f8; border-bottom: 1px solid #ddd;">
                    <h3 style="margin: 0;">Действия</h3>
                </div>
                
                <div style="padding: 20px;">
                    @if($place->isAvailable())
                    <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
                        Место доступно для хранения вещей
                    </div>
                    @else
                    <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
                        Место недоступно для новых вещей
                    </div>
                    @endif
                    
                    <div style="display: flex; flex-direction: column; gap: 10px;">
                        <a href="{{ route('things.index') }}" 
                           style="background: #007bff; color: white; padding: 12px; text-decoration: none; border-radius: 4px; text-align: center;">
                            Найти вещи
                        </a>
                        
                        @can('update', $place)
                        <a href="{{ route('places.edit', $place) }}" 
                           style="background: #ffc107; color: #000; padding: 12px; text-decoration: none; border-radius: 4px; text-align: center;">
                            Изменить статус
                        </a>
                        @endcan
                        
                        @can('delete', $place)
                        <form action="{{ route('places.destroy', $place) }}" method="POST" 
                              onsubmit="return confirm('Удалить это место хранения?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    style="background: #dc3545; color: white; padding: 12px; border: none; border-radius: 4px; width: 100%; cursor: pointer;">
                                Удалить место
                            </button>
                        </form>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>