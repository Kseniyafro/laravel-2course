<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мои вещи, используемые другими</title>
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
            border-bottom: 2px solid #fd7e14;
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
            border-left: 4px solid #fd7e14;
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
        
        .item-footer {
            margin-top: auto;
        }
        
        .item-actions {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        .btn {
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
            border: none;
            cursor: pointer;
        }
        
        .btn-view {
            background-color: #17a2b8;
            color: white;
        }
        
        .btn-edit {
            background-color: #ffc107;
            color: #000;
        }
        
        .btn-return {
            background-color: #dc3545;
            color: white;
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
            color: #fd7e14;
            text-decoration: none;
        }
        
        .page-link.active {
            background-color: #fd7e14;
            color: white;
            border-color: #fd7e14;
        }
        
        @media (max-width: 768px) {
            .items-grid {
                grid-template-columns: 1fr;
            }
            
            .item-actions {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Мои вещи, используемые другими</h1>
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
                        
                        <div class="item-footer">
                            <div class="item-actions">
                                <a href="{{ route('things.show', $thing) }}" class="btn btn-view">
                                    Просмотр
                                </a>
                                
                                @if($thing->master == Auth::id())
                                    <a href="{{ route('things.edit', $thing) }}" class="btn btn-edit">
                                        Редактировать
                                    </a>
                                    
                                    <form action="{{ route('things.return', $thing) }}" method="POST" style="margin: 0;">
                                        @csrf
                                        <button type="submit" 
                                                class="btn btn-return"
                                                onclick="return confirm('Вернуть эту вещь?')">
                                            Вернуть
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-message">
                <h3>У вас нет вещей, которые используются другими</h3>
                <p>Здесь будут отображаться ваши вещи, переданные другим пользователям</p>
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