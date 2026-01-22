<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вещи в работе</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .header {
            margin-bottom: 30px;
        }
        
        .header h1 {
            margin: 0;
            color: #333;
            padding-bottom: 10px;
            border-bottom: 2px solid #ffc107;
        }
        
        .items-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .item-card {
            background: white;
            border: 1px solid #ddd;
            border-left: 4px solid #ffc107;
            border-radius: 4px;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }
        
        .item-title {
            margin: 0 0 15px 0;
            font-size: 18px;
            color: #333;
        }
        
        .item-description {
            color: #666;
            line-height: 1.5;
            margin-bottom: 20px;
            flex: 1;
        }
        
        .item-info {
            margin-bottom: 20px;
        }
        
        .info-row {
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .info-label {
            font-weight: bold;
            color: #555;
            display: block;
            margin-bottom: 3px;
        }
        
        .details-button {
            display: inline-block;
            background-color: #17a2b8;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            text-align: center;
            width: 100%;
        }
        
        .details-button:hover {
            background-color: #138496;
        }
        
        .empty-message {
            text-align: center;
            padding: 40px 20px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 4px;
            color: #666;
            grid-column: 1 / -1;
        }
        
        .pagination {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            flex-wrap: wrap;
        }
        
        .page-link {
            padding: 8px 12px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 4px;
            color: #ffc107;
            text-decoration: none;
        }
        
        .page-link.active {
            background-color: #ffc107;
            color: white;
            border-color: #ffc107;
        }
        
        @media (max-width: 768px) {
            .items-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Вещи в работе</h1>
        </div>

        @if($things->count() > 0)
            <div class="items-grid">
                @foreach($things as $thing)
                    <div class="item-card">
                        <h3 class="item-title">{{ $thing->name }}</h3>
                        
                        @if($thing->description)
                            <div class="item-description">
                                {{ Str::limit($thing->description, 100) }}
                            </div>
                        @endif
                        
                        <div class="item-info">
                            <div class="info-row">
                                <span class="info-label">Владелец:</span>
                                {{ $thing->owner->name }}
                            </div>
                            
                            <div class="info-row">
                                <span class="info-label">Гарантия:</span>
                                {{ $thing->wrnt ? $thing->wrnt->format('d.m.Y') : 'нет' }}
                            </div>
                            
                            @if($thing->currentUsage())
                                <div class="info-row">
                                    <span class="info-label">Пользователь:</span>
                                    {{ $thing->currentUser()->name }}
                                </div>
                                
                                <div class="info-row">
                                    <span class="info-label">Место:</span>
                                    {{ $thing->currentPlace()->name }}
                                </div>
                                
                                <div class="info-row" style="border-bottom: none;">
                                    <span class="info-label">Количество:</span>
                                    {{ $thing->currentUsage()->formatted_amount }}
                                </div>
                            @endif
                        </div>
                        
                        <a href="{{ route('things.show', $thing) }}" class="details-button">
                            Подробнее
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-message">
                <h3>Нет вещей в работе</h3>
                <p>Здесь будут отображаться вещи, находящиеся в работе</p>
            </div>
        @endif

        @if($things->hasPages())
            <div class="pagination">
                @for ($page = 1; $page <= $things->lastPage(); $page++)
                    <a href="{{ $things->url($page) }}" 
                       class="page-link {{ $things->currentPage() == $page ? 'active' : '' }}">
                        {{ $page }}
                    </a>
                @endfor
            </div>
        @endif
    </div>
</body>
</html>