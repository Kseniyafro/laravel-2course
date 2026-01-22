<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Доступные вещи</title>
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
        
        .auth-message {
            background-color: #d1ecf1;
            border: 1px solid #bee5eb;
            border-radius: 4px;
            padding: 15px;
            color: #0c5460;
            margin-bottom: 20px;
        }
        
        .auth-message a {
            color: #007bff;
            text-decoration: none;
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
        
        .my-item-card {
            border: 2px solid #28a745;
            background-color: #f8fff9;
        }
        
        .item-title {
            margin: 0 0 15px 0;
            font-size: 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .item-badge {
            background-color: #28a745;
            color: white;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
        }
        
        .item-description {
            color: #666;
            line-height: 1.5;
            margin-bottom: 15px;
            flex: 1;
        }
        
        .item-owner {
            color: #777;
            font-size: 14px;
            margin-bottom: 15px;
        }
        
        .owner-you {
            color: #28a745;
            font-weight: bold;
        }
        
        .in-use {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 4px;
            padding: 10px;
            margin-bottom: 15px;
            color: #856404;
            font-size: 14px;
        }
        
        .item-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            border-top: 1px solid #eee;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .action-button {
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
            border: 1px solid;
            cursor: pointer;
            background: white;
        }
        
        .view-button {
            border-color: #007bff;
            color: #007bff;
        }
        
        .edit-button {
            border-color: #28a745;
            color: #28a745;
        }
        
        .delete-button {
            border-color: #dc3545;
            color: #dc3545;
            background: white;
        }
        
        .take-button {
            border-color: #6c757d;
            color: #6c757d;
            background: #f8f9fa;
            cursor: not-allowed;
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
                align-items: stretch;
            }
            
            .action-button {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Все вещи</h1>
            @auth
                <a href="{{ route('things.create') }}" class="add-button">
                    Добавить вещь
                </a>
            @endauth
        </div>

        @guest
            <div class="auth-message">
                Для управления вещами необходимо 
                <a href="{{ route('login') }}">войти</a> или 
                <a href="{{ route('register') }}">зарегистрироваться</a>
            </div>
        @endguest

        @if($things->count() > 0)
            <div class="items-grid">
                @foreach($things as $thing)
                    @php
                        $isMyThing = Auth::check() && $thing->master == Auth::id();
                        $inUse = $thing->usages->first() && $thing->usages->first()->user;
                        $usage = $thing->usages->first();
                    @endphp
                    
                    <div class="item-card {{ $isMyThing ? 'my-item-card' : '' }}">
                        <div class="item-title">
                            <span>{{ $thing->name }}</span>
                            @if($isMyThing)
                                <span class="item-badge">Моя</span>
                            @endif
                        </div>
                        
                        @if($thing->description)
                            <div class="item-description">
                                {{ Str::limit($thing->description, 100) }}
                            </div>
                        @endif
                        
                        <div class="item-owner">
                            Владелец: 
                            @if($isMyThing)
                                <span class="owner-you">Вы</span>
                            @else
                                {{ $thing->owner->name }}
                            @endif
                        </div>
                        
                        @if($inUse)
                            <div class="in-use">
                                Используется: {{ $usage->user->name }}
                                @if($usage->amount > 0)
                                    <br>Количество: {{ $usage->formatted_amount }}
                                @endif
                            </div>
                        @endif
                        
                        <div class="item-actions">
                            <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                                <a href="{{ route('things.show', $thing) }}" class="action-button view-button">
                                    Просмотр
                                </a>
                                
                                @if($isMyThing)
                                    <a href="{{ route('things.edit', $thing) }}" class="action-button edit-button">
                                        Редактировать
                                    </a>
                                    
                                    <form action="{{ route('things.destroy', $thing) }}" method="POST" style="margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="action-button delete-button"
                                                onclick="return confirm('Удалить эту вещь?')">
                                            Удалить
                                        </button>
                                    </form>
                                @endif
                            </div>
                            
                            @guest
                                <button class="action-button take-button" disabled>
                                    Требуется вход
                                </button>
                            @endguest
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-message">
                <h3>Пока нет доступных вещей</h3>
                <p>Здесь будут отображаться все вещи</p>
                @auth
                    <a href="{{ route('things.create') }}" class="add-button" style="display: inline-block; margin-top: 15px;">
                        Добавить первую вещь
                    </a>
                @endauth
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