<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить вещь</title>
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
            border-bottom: 2px solid #007bff;
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
        
        select.form-input {
            background-color: white;
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
        
        .btn:hover {
            opacity: 0.9;
        }
        
        .option-description {
            color: #666;
            font-size: 14px;
            margin-left: 5px;
        }
        
        .option-warning {
            color: #dc3545;
            font-weight: bold;
        }
        
        .option-alert {
            color: #ffc107;
            font-weight: bold;
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
            <h1>Добавить новую вещь</h1>
        </div>
        
        <div class="form-card">
            <form method="POST" action="{{ route('things.store') }}">
                @csrf
                
                <div class="form-section">
                    <label for="name" class="form-label required">Название</label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           class="form-input {{ $errors->has('name') ? 'error' : '' }}"
                           value="{{ old('name') }}" 
                           required 
                           autofocus>
                    @if($errors->has('name'))
                        <div class="error-message">{{ $errors->first('name') }}</div>
                    @endif
                </div>
                
                <div class="form-section">
                    <label for="description" class="form-label">Описание</label>
                    <textarea id="description" 
                              name="description" 
                              class="form-input {{ $errors->has('description') ? 'error' : '' }}"
                              rows="4">{{ old('description') }}</textarea>
                    @if($errors->has('description'))
                        <div class="error-message">{{ $errors->first('description') }}</div>
                    @endif
                </div>
                
                <div class="form-section">
                    <label for="wrnt" class="form-label">Гарантия (дата окончания)</label>
                    <input type="date" 
                           id="wrnt" 
                           name="wrnt" 
                           class="form-input {{ $errors->has('wrnt') ? 'error' : '' }}"
                           value="{{ old('wrnt') }}">
                    @if($errors->has('wrnt'))
                        <div class="error-message">{{ $errors->first('wrnt') }}</div>
                    @endif
                </div>
                
                <div class="form-section">
                    <label for="place_id" class="form-label">Место хранения</label>
                    <select id="place_id" 
                            name="place_id" 
                            class="form-input {{ $errors->has('place_id') ? 'error' : '' }}">
                        <option value="">-- Не указывать место --</option>
                        @foreach(App\Models\Place::all() as $place)
                            <option value="{{ $place->id }}" 
                                {{ old('place_id') == $place->id ? 'selected' : '' }}>
                                {{ $place->name }}
                                @if($place->repair) 
                                    <span class="option-warning">(Ремонт)</span>
                                @elseif($place->work)
                                    <span class="option-alert">(Работа)</span>
                                @endif
                            </option>
                        @endforeach
                    </select>
                    <span class="hint-text">Можно добавить вещь сразу в место хранения</span>
                    @if($errors->has('place_id'))
                        <div class="error-message">{{ $errors->first('place_id') }}</div>
                    @endif
                </div>
                
                <div class="form-section">
                    <label for="unit_id" class="form-label">Единица измерения</label>
                    <select id="unit_id" 
                            name="unit_id" 
                            class="form-input {{ $errors->has('unit_id') ? 'error' : '' }}">
                        <option value="">-- Выберите единицу измерения --</option>
                        @foreach(App\Models\Unit::all() as $unit)
                            <option value="{{ $unit->id }}" 
                                {{ old('unit_id') == $unit->id ? 'selected' : '' }}>
                                {{ $unit->display }}
                            </option>
                        @endforeach
                    </select>
                    <span class="hint-text">В чем измеряется эта вещь</span>
                    @if($errors->has('unit_id'))
                        <div class="error-message">{{ $errors->first('unit_id') }}</div>
                    @endif
                </div>
                
                <div class="form-section">
                    <label for="amount" class="form-label">Количество</label>
                    <input type="number" 
                           id="amount" 
                           name="amount" 
                           class="form-input {{ $errors->has('amount') ? 'error' : '' }}"
                           value="{{ old('amount', 1) }}" 
                           min="1" 
                           step="0.01">
                    <span class="hint-text">Сколько единиц этой вещи</span>
                    @if($errors->has('amount'))
                        <div class="error-message">{{ $errors->first('amount') }}</div>
                    @endif
                </div>
                
                <div class="form-actions">
                    <a href="{{ route('things.index') }}" class="btn btn-secondary">
                        Назад к списку
                    </a>
                    
                    <button type="submit" class="btn btn-primary">
                        Сохранить вещь
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
