<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель управления</title>
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
        
        .dashboard-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }
        
        @media (max-width: 768px) {
            .dashboard-wrapper {
                grid-template-columns: 1fr;
            }
        }
        
        .dashboard-card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 4px;
            overflow: hidden;
        }
        
        .card-header {
            padding: 20px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #ddd;
        }
        
        .card-header h3 {
            margin: 0;
            color: #333;
        }
        
        .card-body {
            padding: 20px;
        }
        
        .items-list {
            margin-bottom: 20px;
        }
        
        .item-card {
            border: 1px solid #eee;
            border-radius: 4px;
            padding: 15px;
            margin-bottom: 10px;
            background-color: white;
        }
        
        .item-card:hover {
            background-color: #f8f9fa;
        }
        
        .item-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 10px;
        }
        
        .item-name {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
        }
        
        .item-badge {
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
        }
        
        .badge-in-use {
            background-color: #ffc107;
            color: #000;
        }
        
        .badge-available {
            background-color: #28a745;
            color: white;
        }
        
        .item-description {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
        }
        
        .item-details {
            font-size: 14px;
            color: #777;
        }
        
        .item-details p {
            margin: 5px 0;
        }
        
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #666;
        }
        
        .card-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        
        .btn {
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            display: inline-block;
            text-align: center;
        }
        
        .btn-primary {
            background-color: #007bff;
            color: white;
        }
        
        .btn-outline-primary {
            background-color: white;
            color: #007bff;
            border: 1px solid #007bff;
        }
        
        .btn-success {
            background-color: #28a745;
            color: white;
        }
        
        .btn-outline-success {
            background-color: white;
            color: #28a745;
            border: 1px solid #28a745;
        }
        
        .btn:hover {
            opacity: 0.9;
        }
        
        a.item-link {
            color: inherit;
            text-decoration: none;
            display: block;
        }
        
        a.item-link:hover {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="dashboard-wrapper">
            <!-- Мои вещи -->
            <div class="dashboard-card">
                <div class="card-header">
                    <h3>Мои вещи</h3>
                </div>
                
                <div class="card-body">
                    @if($myThings->count() > 0)
                        <div class="items-list">
                            @foreach($myThings as $thing)
                                <a href="{{ route('things.show', $thing) }}" class="item-link">
                                    <div class="item-card">
                                        <div class="item-header">
                                            <div class="item-name">{{ $thing->name }}</div>
                                            <div>
                                                @if($thing->usages->count() > 0)
                                                    <span class="item-badge badge-in-use">В использовании</span>
                                                @else
                                                    <span class="item-badge badge-available">Доступна</span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        @if($thing->description)
                                            <div class="item-description">
                                                {{ Str::limit($thing->description, 50) }}
                                            </div>
                                        @endif
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <p>У вас пока нет вещей</p>
                        </div>
                    @endif
                    
                    <div class="card-actions">
                        <a href="{{ route('things.create') }}" class="btn btn-primary">
                            Добавить вещь
                        </a>
                        <a href="{{ route('things.my') }}" class="btn btn-outline-primary">
                            Все мои вещи
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Взятые мной вещи -->
            <div class="dashboard-card">
                <div class="card-header">
                    <h3>Взятые мной вещи</h3>
                </div>
                
                <div class="card-body">
                    @if($borrowedThings->count() > 0)
                        <div class="items-list">
                            @foreach($borrowedThings as $usage)
                                <div class="item-card">
                                    <div class="item-header">
                                        <div class="item-name">{{ $usage->thing->name }}</div>
                                        <div>{{ $usage->amount }} шт.</div>
                                    </div>
                                    
                                    <div class="item-details">
                                        <p>Владелец: {{ $usage->thing->owner->name }}</p>
                                        <p>Место: {{ $usage->place->name }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <p>Вы пока не взяли ни одной вещи</p>
                        </div>
                    @endif
                    
                    <div class="card-actions">
                        <a href="{{ route('things.index') }}" class="btn btn-success">
                            Найти вещи
                        </a>
                        <a href="{{ route('things.borrowed') }}" class="btn btn-outline-success">
                            Все взятые вещи
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>