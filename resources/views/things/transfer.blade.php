<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Передача вещи: {{ $thing->name }}</title>
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
        
        .thing-name {
            color: #666;
            font-size: 18px;
            margin-top: 10px;
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
        
        select.form-input {
            background-color: white;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        
        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }
        
        .info-box {
            background-color: #e7f3ff;
            border: 1px solid #b8daff;
            border-radius: 4px;
            padding: 20px;
            margin: 25px 0;
            color: #004085;
        }
        
        .info-title {
            font-weight: bold;
            margin-bottom: 10px;
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
        
        .place-status {
            font-size: 14px;
            margin-left: 5px;
        }
        
        .status-repair {
            color: #dc3545;
            font-weight: bold;
        }
        
        .status-work {
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
            <h1>Передача вещи</h1>
            <div class="thing-name">{{ $thing->name }}</div>
        </div>
        
        <div class="form-card">
            <form method="POST" action="{{ route('things.transfer', $thing) }}">
                @csrf
                
                <div class="form-section">
                    <label for="user_id" class="form-label required">Пользователь</label>
                    <select id="user_id" 
                            name="user_id" 
                            class="form-input {{ $errors->has('user_id') ? 'error' : '' }}"
                            required>
                        <option value="">Выберите пользователя</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has('user_id'))
                        <div class="error-message">{{ $errors->first('user_id') }}</div>
                    @endif
                </div>
                
                <div class="form-section">
                    <label for="place_id" class="form-label required">Место хранения</label>
                    <select id="place_id" 
                            name="place_id" 
                            class="form-input {{ $errors->has('place_id') ? 'error' : '' }}"
                            required>
                        <option value="">Выберите место хранения</option>
                        @foreach($places as $place)
                            <option value="{{ $place->id }}" {{ old('place_id') == $place->id ? 'selected' : '' }}>
                                {{ $place->name }}
                                @if($place->repair)
                                    <span class="place-status status-repair">(Ремонт)</span>
                                @endif
                                @if($place->work)
                                    <span class="place-status status-work">(В работе)</span>
                                @endif
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has('place_id'))
                        <div class="error-message">{{ $errors->first('place_id') }}</div>
                    @endif
                </div>
                
                <div class="form-row">
                    <div class="form-section">
                        <label for="amount" class="form-label required">Количество</label>
                        <input type="number" 
                               id="amount" 
                               name="amount" 
                               class="form-input {{ $errors->has('amount') ? 'error' : '' }}"
                               value="{{ old('amount', 1) }}" 
                               min="1" 
                               required>
                        @if($errors->has('amount'))
                            <div class="error-message">{{ $errors->first('amount') }}</div>
                        @endif
                    </div>
                    
                    <div class="form-section">
                        <label for="unit_id" class="form-label">Единица измерения</label>
                        <select id="unit_id" 
                                name="unit_id" 
                                class="form-input {{ $errors->has('unit_id') ? 'error' : '' }}">
                            <option value="">Выберите единицу</option>
                            @foreach($units as $unit)
                                <option value="{{ $unit->id }}" {{ old('unit_id') == $unit->id ? 'selected' : '' }}>
                                    {{ $unit->name }} ({{ $unit->abbreviation }})
                                </option>
                            @endforeach
                        </select>
                        @if($errors->has('unit_id'))
                            <div class="error-message">{{ $errors->first('unit_id') }}</div>
                        @endif
                    </div>
                </div>
                
                <div class="info-box">
                    <div class="info-title">Важная информация</div>
                    <p>После передачи вещь будет доступна выбранному пользователю. Вы сможете вернуть ее в любое время.</p>
                </div>
                
                <div class="form-actions">
                    <a href="{{ route('things.show', $thing) }}" class="btn btn-secondary">
                        Назад
                    </a>
                    
                    <button type="submit" class="btn btn-primary">
                        Передать вещь
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>