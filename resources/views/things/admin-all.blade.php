<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Все вещи (админ)</title>
</head>
<body style="font-family: Arial; margin: 20px;">
    <h1 style="border-bottom: 2px solid #dc3545; padding-bottom: 10px;">
        Все вещи (административный просмотр)
    </h1>

    @if($things->count() > 0)
        <div style="overflow-x: auto; margin: 20px 0;">
            <table style="width: 100%; border-collapse: collapse; background: white;">
                <thead>
                    <tr style="background: #333; color: white;">
                        <th style="padding: 12px; border: 1px solid #ddd;">ID</th>
                        <th style="padding: 12px; border: 1px solid #ddd;">Название</th>
                        <th style="padding: 12px; border: 1px solid #ddd;">Владелец</th>
                        <th style="padding: 12px; border: 1px solid #ddd;">Гарантия</th>
                        <th style="padding: 12px; border: 1px solid #ddd;">Пользователь</th>
                        <th style="padding: 12px; border: 1px solid #ddd;">Место</th>
                        <th style="padding: 12px; border: 1px solid #ddd;">Кол-во</th>
                        <th style="padding: 12px; border: 1px solid #ddd;">Создано</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($things as $thing)
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 12px; border: 1px solid #ddd;">{{ $thing->id }}</td>
                        <td style="padding: 12px; border: 1px solid #ddd;">{{ $thing->name }}</td>
                        <td style="padding: 12px; border: 1px solid #ddd;">{{ $thing->owner->name }}</td>
                        <td style="padding: 12px; border: 1px solid #ddd;">
                            {{ $thing->wrnt ? $thing->wrnt->format('d.m.Y') : '—' }}
                        </td>
                        <td style="padding: 12px; border: 1px solid #ddd;">
                            {{ $thing->latest_user ? $thing->latest_user->name : '—' }}
                        </td>
                        <td style="padding: 12px; border: 1px solid #ddd;">
                            {{ $thing->latest_place ? $thing->latest_place->name : '—' }}
                        </td>
                        <td style="padding: 12px; border: 1px solid #ddd;">
                            @if($thing->latest_usage)
                                {{ $thing->latest_usage->amount }}
                                @if($thing->latest_usage->unit)
                                    {{ $thing->latest_usage->unit->abbreviation }}
                                @endif
                            @else
                                —
                            @endif
                        </td>
                        <td style="padding: 12px; border: 1px solid #ddd;">{{ $thing->created_at->format('d.m.Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div style="text-align: center; padding: 40px; color: #666;">
            Нет вещей
        </div>
    @endif

    @if($things->hasPages())
        <div style="text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd;">
            @for ($page = 1; $page <= $things->lastPage(); $page++)
                <a href="{{ $things->url($page) }}" 
                   style="display: inline-block; padding: 5px 10px; margin: 0 2px;
                          background: {{ $things->currentPage() == $page ? '#dc3545' : '#f0f0f0' }};
                          color: {{ $things->currentPage() == $page ? 'white' : '#333' }};
                          text-decoration: none; border: 1px solid #ddd;">
                    {{ $page }}
                </a>
            @endfor
        </div>
    @endif
</body>
</html>