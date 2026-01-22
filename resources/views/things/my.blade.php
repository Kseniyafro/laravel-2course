<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мои вещи</title>
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
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 20px;
        }
        
        .header h1 {
            margin: 0;
            color: #333;
        }
        
        .add-button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        
        .add-button:hover {
            background-color: #0056b3;
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
            border-radius: 4px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        
        .item-title {
            margin: 0 0 15px 0;
            font-size: 18px;
            color: #333;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
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
        
        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: bold;
        }
        
        .status-available {
            background-color: #28a745;
            color: white;
        }
        
        .status-in-use {
            background-color: #ffc107;
            color: #000;
        }
        
        .item-actions {
            display: flex;
            gap: 10px;
            margin-top: auto;
        }
        
        .action-button {
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
            border: none;
            cursor: pointer;
            flex: 1;
            text-align: center;
        }
        
        .view-button {
            background-color: #17a2b8;
            color: white;
        }
        
        .edit-button {
            background-color: #ffc107;
            color: #000;
        }
        
        .delete-button {
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
        
        .empty-message a {
            color: #007bff;
            text-decoration: none;
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
            color: #007bff;
            text-decoration: none;
        }
        
        .page-link.active {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }
        
        @media (max-width: 768px) {
            .items-grid {
                grid-template-columns: 1fr;
            }
            
            .header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .item-actions {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Мои вещи</h1>
            <a href="{{ route('things.create') }}" class="add-button">
                Добавить вещь
            </a>
        </div>

        @if($things->count() > 0)
            <div class="items-grid">
                @foreach($things as $thing)
                    <div class="item-card">
                        <h3 class="item-title">{{ $thing->name }}</h3>
                        
                        <div class="item-description">
                            @if($thing->currentDescription)
                                {{ \Illuminate\Support\Str::limit($thing->currentDescription->description, 100) }}
                            @elseif($thing->description)
                                {{ \Illuminate\Support\Str::limit($thing->description, 100) }}
                            @else
                                Нет описания
                            @endif
                        </div>
                        
                        <div class="item-info">
                            <div class="info-row">
                                <span class="info-label">Гарантия:</span>
                                {{ $thing->wrnt ? $thing->wrnt->format('d.m.Y') : 'нет' }}
                            </div>
                            
                            <div class="info-row">
                                <span class="info-label">Статус:</span>
                                @if($thing->isInUse())
                                    @php
                                        $usage = $thing->currentUsage();
                                    @endphp
                                    <span class="status-badge status-in-use">
                                        У пользователя: {{ $usage->user->name }}
                                    </span>
                                @else
                                    <span class="status-badge status-available">
                                        Доступна
                                    </span>
                                @endif
                            </div>
                            
                            @if($thing->isInUse())
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
                        
                        <div class="item-actions">
                            <a href="{{ route('things.show', $thing) }}" class="action-button view-button">
                                Просмотр
                            </a>
                            
                            <a href="{{ route('things.edit', $thing) }}" class="action-button edit-button">
                                Редактировать
                            </a>
                            
                            <form action="{{ route('things.destroy', $thing) }}" method="POST" style="flex: 1;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="action-button delete-button"
                                        onclick="return confirm('Удалить эту вещь?')">
                                    Удалить
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-message">
                <h3>У вас пока нет вещей</h3>
                <p><a href="{{ route('things.create') }}">Создать первую вещь</a></p>
            </div>
        @endif

        @if($things->hasPages())
            <div class="pagination">
                @php
                    $currentPage = $things->currentPage();
                    $lastPage = $things->lastPage();
                    
                    // Показываем первые 2 страницы
                    for ($i = 1; $i <= min(2, $lastPage); $i++) {
                        echo '<a href="' . $things->url($i) . '" class="page-link ' . ($currentPage == $i ? 'active' : '') . '">' . $i . '</a>';
                    }
                    
                    // Показываем текущую страницу и соседние
                    if ($currentPage > 3) {
                        echo '<span style="padding: 8px 12px;">...</span>';
                    }
                    
                    for ($i = max(3, $currentPage - 1); $i <= min($lastPage - 2, $currentPage + 1); $i++) {
                        if ($i > 2) {
                            echo '<a href="' . $things->url($i) . '" class="page-link ' . ($currentPage == $i ? 'active' : '') . '">' . $i . '</a>';
                        }
                    }
                    
                    if ($currentPage < $lastPage - 2) {
                        echo '<span style="padding: 8px 12px;">...</span>';
                    }
                    
                    // Показываем последние 2 страницы
                    for ($i = max($lastPage - 1, $currentPage + 2); $i <= $lastPage; $i++) {
                        if ($i > $currentPage + 1) {
                            echo '<a href="' . $things->url($i) . '" class="page-link ' . ($currentPage == $i ? 'active' : '') . '">' . $i . '</a>';
                        }
                    }
                @endphp
            </div>
        @endif
    </div>
</body>
</html>