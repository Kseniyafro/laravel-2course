<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель управления</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        
        .dashboard {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 20px;
        }
        
        .card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 25px;
        }
        
        .card-title {
            margin: 0 0 20px 0;
            font-size: 20px;
            color: #333;
            padding-bottom: 10px;
            border-bottom: 2px solid #007bff;
        }
        
        .thing-item {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 12px;
        }
        
        .thing-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }
        
        .thing-name {
            font-weight: bold;
            font-size: 16px;
            color: #333;
            margin: 0;
        }
        
        .status {
            font-size: 12px;
            padding: 3px 8px;
            border-radius: 4px;
        }
        
        .status-using {
            background: #ffc107;
            color: #333;
        }
        
        .status-free {
            background: #28a745;
            color: white;
        }
        
        .thing-description {
            color: #666;
            font-size: 14px;
            line-height: 1.4;
            margin-bottom: 8px;
        }
        
        .thing-details {
            font-size: 13px;
            color: #6c757d;
        }
        
        .thing-details p {
            margin: 4px 0;
        }
        
        .no-items {
            text-align: center;
            color: #6c757d;
            padding: 30px 20px;
        }
        
        .actions {
            margin-top: 25px;
            display: flex;
            gap: 10px;
        }
        
        .button {
            display: inline-block;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            text-align: center;
        }
        
        .button-primary {
            background: #007bff;
            color: white;
            border: none;
        }
        
        .button-outline {
            background: white;
            border: 2px solid #007bff;
            color: #007bff;
        }
        
        .button-green {
            background: #28a745;
            color: white;
            border: none;
        }
        
        .button-outline-green {
            background: white;
            border: 2px solid #28a745;
            color: #28a745;
        }
        
        @media (max-width: 768px) {
            .dashboard {
                grid-template-columns: 1fr;
            }
            
            .actions {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <!-- Мои вещи -->
        <div class="card">
            <h2 class="card-title">Мои вещи</h2>
            
            @if($myThings->count() > 0)
                @foreach($myThings as $thing)
                    <a href="{{ route('things.show', $thing) }}" style="text-decoration: none; color: inherit;">
                        <div class="thing-item">
                            <div class="thing-header">
                                <div class="thing-name">{{ $thing->name }}</div>
                                <div class="status {{ $thing->usages->count() > 0 ? 'status-using' : 'status-free' }}">
                                    {{ $thing->usages->count() > 0 ? 'В использовании' : 'Доступна' }}
                                </div>
                            </div>
                            
                            @if($thing->description)
                                <div class="thing-description">
                                    {{ Str::limit($thing->description, 50) }}
                                </div>
                            @endif
                        </div>
                    </a>
                @endforeach
            @else
                <div class="no-items">
                    <p>У вас пока нет вещей</p>
                </div>
            @endif
            
            <div class="actions">
                <a href="{{ route('things.create') }}" class="button button-primary">
                    Добавить вещь
                </a>
                <a href="{{ route('things.my') }}" class="button button-outline">
                    Все мои вещи
                </a>
            </div>
        </div>
        
        <!-- Взятые мной вещи -->
        <div class="card">
            <h2 class="card-title">Взятые мной вещи</h2>
            
            @if($borrowedThings->count() > 0)
                @foreach($borrowedThings as $usage)
                    <div class="thing-item">
                        <div class="thing-header">
                            <div class="thing-name">{{ $usage->thing->name }}</div>
                            <div style="font-size: 14px; color: #495057;">
                                {{ $usage->amount }} шт.
                            </div>
                        </div>
                        
                        <div class="thing-details">
                            <p>Владелец: {{ $usage->thing->owner->name }}</p>
                            <p>Место: {{ $usage->place->name }}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="no-items">
                    <p>Вы пока не взяли ни одной вещи</p>
                </div>
            @endif
            
            <div class="actions">
                <a href="{{ route('things.index') }}" class="button button-green">
                    Найти вещи
                </a>
                <a href="{{ route('things.borrowed') }}" class="button button-outline-green">
                    Все взятые вещи
                </a>
            </div>
        </div>
    </div>
</body>
</html>
