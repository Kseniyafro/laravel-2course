<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Storage of Things</title>
    <style>
        /* Базовые стили и сброс */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
            line-height: 1.6;
        }

        /* Навигационная панель */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 2rem;
            padding: 1rem 0;
        }

        .nav-link {
            text-decoration: none;
            color: #4a5568;
            font-weight: 500;
            font-size: 1rem;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            color: #667eea;
            background: rgba(102, 126, 234, 0.1);
            transform: translateY(-1px);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after {
            width: 80%;
        }

        /* Основной контент */
        .main-content {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            margin: 2rem auto;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            max-width: 1000px;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h1 {
            color: #2d3748;
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            background: linear-gradient(90deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-align: center;
        }

        /* Уведомления */
        .alert {
            padding: 1.2rem 1.5rem;
            border-radius: 12px;
            margin: 1.5rem 0;
            border: none;
            font-size: 1rem;
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .alert-success {
            background: linear-gradient(135deg, #48bb78, #38a169);
            color: white;
            box-shadow: 0 4px 15px rgba(72, 187, 120, 0.3);
        }

        .alert-warning {
            background: linear-gradient(135deg, #ed8936, #dd6b20);
            color: white;
            box-shadow: 0 4px 15px rgba(237, 137, 54, 0.3);
        }

        .alert-info {
            background: linear-gradient(135deg, #4299e1, #3182ce);
            color: white;
            box-shadow: 0 4px 15px rgba(66, 153, 225, 0.3);
            margin-top: 1.5rem;
        }

        .alert a {
            color: white;
            text-decoration: underline;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .alert a:hover {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
        }

        /* Списки */
        ul {
            list-style: none;
            padding: 0;
        }

        .alert-info ul {
            margin-top: 0.8rem;
        }

        .alert-info li {
            padding: 0.8rem 1rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.3s ease;
        }

        .alert-info li:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateX(5px);
        }

        .alert-info li a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            flex-grow: 1;
        }

        .alert-info li a:hover {
            text-decoration: underline;
        }

        /* Адаптивность */
        @media (max-width: 768px) {
            .nav-links {
                flex-wrap: wrap;
                gap: 1rem;
                justify-content: center;
            }
            
            .nav-link {
                font-size: 0.9rem;
                padding: 0.4rem 0.8rem;
            }
            
            h1 {
                font-size: 2rem;
            }
            
            .main-content {
                padding: 1.5rem;
                margin: 1rem;
            }
            
            .alert-info li {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }
        }

        @media (max-width: 480px) {
            .nav-links {
                flex-direction: column;
                gap: 0.5rem;
            }
            
            h1 {
                font-size: 1.5rem;
            }
        }

        /* Анимация для активных элементов */
        .nav-link:active,
        .alert-info li:active {
            transform: scale(0.98);
        }

        /* Стиль для имени пользователя */
        strong {
            font-weight: 600;
            color: white;
            background: rgba(255, 255, 255, 0.2);
            padding: 0.2rem 0.8rem;
            border-radius: 20px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="nav-links">
                <a href="/" class="nav-link">Главная</a>
                <a href="{{ route('things.index') }}" class="nav-link">Список вещей</a>
                <a href="{{ route('places.index') }}" class="nav-link">Места хранения</a>
                @auth
                    <a href="/auth/logout" class="nav-link">Выйти</a>
                @endauth
                
                @guest
                    <a href="/auth/signin" class="nav-link">Регистрация</a>
                    <a href="/auth/login" class="nav-link">Вход</a>
                @endguest
            </div>
        </div>
    </nav>

    <main class="container">
        <div class="main-content">
            <h1>Система хранения вещей</h1>
            
            @auth
                <div class="alert alert-success">
                    <p>Вы авторизованы как <strong>{{ auth()->user()->name }}</strong></p>
                </div>
                @if(auth()->user()->receivedThings()->count() > 0)
                    <div class="alert alert-info">
                        <h4>Вещи, переданные вам:</h4>
                        <ul>
                            @foreach(auth()->user()->receivedThings as $thing)
                                <li>
                                    <a href="{{ route('things.show', ['thing' => $thing->id]) }}">
                                        {{ $thing->name }}
                                    </a>
                                    <span>от {{ $thing->owner->name }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            @else
                <div class="alert alert-warning">
                    <p>Для работы с системой необходимо <a href="/auth/login">войти</a> 
                       или <a href="/auth/signin">зарегистрироваться</a>.</p>
                </div>
            @endauth
            @yield('content')
        </div>
    </main>
</body>
</html>