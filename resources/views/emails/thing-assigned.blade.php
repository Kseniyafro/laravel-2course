<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вам назначена вещь</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.5;
            color: #333333;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
        }
        
        .header {
            background-color: #007bff;
            color: white;
            padding: 25px 20px;
            text-align: center;
        }
        
        .header h1 {
            margin: 0 0 10px 0;
            font-size: 24px;
        }
        
        .header p {
            margin: 0;
            font-size: 16px;
            opacity: 0.9;
        }
        
        .content {
            padding: 30px;
        }
        
        .greeting {
            font-size: 18px;
            margin-bottom: 20px;
        }
        
        .info-card {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            padding: 20px;
            margin: 25px 0;
        }
        
        .info-card h3 {
            margin: 0 0 20px 0;
            color: #333;
            font-size: 18px;
        }
        
        .info-row {
            margin-bottom: 12px;
            display: flex;
        }
        
        .info-label {
            width: 140px;
            font-weight: bold;
            color: #555;
        }
        
        .info-value {
            flex: 1;
        }
        
        .status {
            display: inline-block;
            background-color: #28a745;
            color: white;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 14px;
            margin-top: 15px;
        }
        
        .button {
            display: inline-block;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 4px;
            font-size: 16px;
            margin: 20px 0;
            border: none;
            cursor: pointer;
        }
        
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #666;
            font-size: 14px;
            border-top: 1px solid #dee2e6;
        }
        
        .divider {
            height: 1px;
            background-color: #dee2e6;
            margin: 25px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Storage of Things</h1>
            <p>Система управления хранением</p>
        </div>
        
        <div class="content">
            <div class="greeting">
                Здравствуйте, {{ $recipient->name }}!
            </div>
            
            <p>Вам была назначена вещь в системе управления хранением.</p>
            
            <div class="info-card">
                <h3>Информация о вещи</h3>
                
                <div class="info-row">
                    <div class="info-label">Название:</div>
                    <div class="info-value"><strong>{{ $thing->name }}</strong></div>
                </div>
                
                @if($thing->description)
                <div class="info-row">
                    <div class="info-label">Описание:</div>
                    <div class="info-value">{{ $thing->description }}</div>
                </div>
                @endif
                
                <div class="info-row">
                    <div class="info-label">Владелец:</div>
                    <div class="info-value">{{ $owner->name }}</div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Количество:</div>
                    <div class="info-value">{{ $formattedAmount }}</div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Место хранения:</div>
                    <div class="info-value">{{ $place->name }}</div>
                </div>
                
                @if($thing->wrnt)
                <div class="info-row">
                    <div class="info-label">Гарантия до:</div>
                    <div class="info-value">{{ $thing->wrnt->format('d.m.Y') }}</div>
                </div>
                @endif
                
                <div class="info-row">
                    <div class="info-label">Дата назначения:</div>
                    <div class="info-value">{{ now()->format('d.m.Y H:i') }}</div>
                </div>
                
                <div class="status">
                    Вещь назначена
                </div>
            </div>
            
            <p>Для просмотра подробной информации перейдите по ссылке:</p>
            
            <a href="{{ url('/things/' . $thing->id) }}" class="button">
                Открыть вещь
            </a>
            
            <div class="divider"></div>
            
            <p style="color: #666; font-size: 14px;">
                Это автоматическое уведомление. Пожалуйста, не отвечайте на это письмо.
            </p>
        </div>
        
        <div class="footer">
            Storage of Things &copy; {{ date('Y') }}
        </div>
    </div>
</body>
</html>