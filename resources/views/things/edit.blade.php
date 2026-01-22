<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать вещь: {{ $thing->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        
        .container {
            max-width: 800px;
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
        
        .access-denied {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
            padding: 20px;
            color: #721c24;
            margin-bottom: 20px;
        }
        
        .form-card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 30px;
        }
        
        .form-section {
            margin-bottom: 25px;
        }
        
        .form-label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #333;
        }
        
        .form-label.required::after {
            content: " *";
            color: #dc3545;
        }
        
        .form-input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #007bff;
        }
        
        .form-input.error {
            border-color: #dc3545;
        }
        
        .form-input:disabled {
            background-color: #f8f9fa;
            color: #666;
        }
        
        .error-message {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
        }
        
        .hint-text {
            color: #666;
            font-size: 14px;
            margin-top: 5px;
            display: block;
        }
        
        textarea.form-input {
            min-height: 100px;
            resize: vertical;
        }
        
        .warning-box {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 4px;
            padding: 15px;
            margin: 20px 0;
            color: #856404;
        }
        
        .danger-zone {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #dc3545;
        }
        
        .danger-title {
            color: #dc3545;
            font-weight: bold;
            margin-bottom: 15px;
        }
        
        .form-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
        }
        
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        
        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }
        
        .btn-primary {
            background-color: #007bff;
            color: white;
        }
        
        .btn-danger {
            background-color: #dc3545;
            color: white;
            margin-top: 10px;
        }
        
        .btn:hover {
            opacity: 0.9;
        }
        
        @media (max-width: 768px) {
            .form-card {
                padding: 20px;
            }
            
            .form-actions {
                flex-direction: column;
                gap: 15px;
            }
            
            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Редактировать вещь: {{ $thing->name }}</h1>
        </div>
        
        @can('update', $thing)
            <div class="form-card">
                <form method="POST" action="{{ route('things.update', $thing) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-section">
                        <label for="name" class="form-label required">Название</label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               class="form-input {{ $errors->has('name') ? 'error' : '' }}"
                               value="{{ old('name', $thing->name) }}" 
                               required 
                               autofocus>
                        @if($errors->has('name'))
                            <div class="error-message">{{ $errors->first('name') }}</div>
                        @endif
                    </div>
                    
                    <div class="form-section">
                        <label for="description" class="form-label">Основное описание</label>
                        <textarea id="description" 
                                  name="description" 
                                  class="form-input {{ $errors->has('description') ? 'error' : '' }}"
                                  rows="4">{{ old('description', $thing->description) }}</textarea>
                        @if($errors->has('description'))
                            <div class="error-message">{{ $errors->first('description') }}</div>
                        @endif
                        <span class="hint-text">
                            Изменение этого поля отправит уведомление владельцу и назначенному пользователю.
                        </span>
                    </div>
                    
                    <div class="form-section">
                        <label for="wrnt" class="form-label">Гарантия/срок годности</label>
                        <input type="date" 
                               id="wrnt" 
                               name="wrnt" 
                               class="form-input {{ $errors->has('wrnt') ? 'error' : '' }}"
                               value="{{ old('wrnt', $thing->wrnt ? $thing->wrnt->format('Y-m-d') : '') }}">
                        @if($errors->has('wrnt'))
                            <div class="error-message">{{ $errors->first('wrnt') }}</div>
                        @endif
                        <span class="hint-text">Дата окончания гарантии или срока годности</span>
                    </div>
                    
                    <div class="form-section">
                        <label class="form-label">Владелец</label>
                        <input type="text" 
                               class="form-input" 
                               value="{{ $thing->owner->name }}" 
                               disabled>
                        <span class="hint-text">Владелец вещи не может быть изменен</span>
                    </div>
                    
                    @if($thing->isInUse())
                    <div class="warning-box">
                        Эта вещь сейчас используется пользователем: 
                        <strong>
                            @php
                                $currentUsage = $thing->currentUsage();
                                $user = $currentUsage ? $currentUsage->user : null;
                            @endphp
                            {{ $user ? $user->name : 'Неизвестно' }}
                        </strong>
                    </div>
                    @endif
                    
                    <div class="form-actions">
                        <a href="{{ route('things.show', $thing) }}" class="btn btn-secondary">
                            Назад к вещи
                        </a>
                        
                        <button type="submit" class="btn btn-primary">
                            Сохранить изменения
                        </button>
                    </div>
                </form>
                
                @if($thing->master == Auth::id() || Auth::user()->isAdmin())
                <div class="danger-zone">
                    <div class="danger-title">Опасная зона</div>
                    <form action="{{ route('things.destroy', $thing) }}" method="POST" 
                          onsubmit="return confirm('Вы уверены, что хотите удалить эту вещь? Это действие нельзя отменить.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            Удалить вещь
                        </button>
                        <span class="hint-text" style="display: block; margin-top: 10px;">
                            Удаление вещи также удалит всю историю использования и описания.
                        </span>
                    </form>
                </div>
                @endif
            </div>
        @else
            <div class="access-denied">
                <strong>Доступ запрещен!</strong>
                <p>У вас нет прав для редактирования этой вещи. Редактировать может только владелец вещи.</p>
            </div>
            
            <a href="{{ route('things.show', $thing) }}" class="btn btn-secondary">
                Назад к вещи
            </a>
        @endcan
    </div>
</body>
</html>