<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Storage of Things')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            padding: 20px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        /* Навигация */
        .navbar {
            background-color: #333;
            color: white;
            padding: 15px 20px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        
        .navbar-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }
        
        .logo {
            font-size: 20px;
            font-weight: bold;
            color: white;
            text-decoration: none;
        }
        
        .nav-menu {
            display: flex;
            gap: 20px;
            list-style: none;
            flex-wrap: wrap;
        }
        
        .nav-link {
            color: #ddd;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 4px;
        }
        
        .nav-link:hover {
            background-color: #444;
        }
        
        .nav-link.active {
            background-color: #007bff;
            color: white;
        }
        
        .dropdown {
            position: relative;
        }
        
        .dropdown-content {
            display: none;
            position: absolute;
            background: white;
            border: 1px solid #ddd;
            border-radius: 4px;
            min-width: 200px;
            z-index: 100;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .dropdown:hover .dropdown-content {
            display: block;
        }
        
        .dropdown-item {
            display: block;
            padding: 10px 15px;
            color: #333;
            text-decoration: none;
            border-bottom: 1px solid #eee;
        }
        
        .dropdown-item:hover {
            background-color: #f5f5f5;
        }
        
        /* Уведомления */
        .notifications {
            position: relative;
        }
        
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #dc3545;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Сообщения */
        .alert {
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            border: 1px solid transparent;
        }
        
        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }
        
        .alert-error {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }
        
        /* Pusher уведомления */
        .pusher-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #28a745;
            color: white;
            padding: 15px;
            border-radius: 4px;
            max-width: 300px;
            z-index: 1000;
            border: 1px solid #218838;
        }
        
        .pusher-notification.fade-out {
            opacity: 0;
            transform: translateX(100%);
            transition: all 0.5s;
        }
        
        /* Кнопки */
        .btn {
            display: inline-block;
            padding: 8px 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
        }
        
        .btn:hover {
            background-color: #0056b3;
        }
        
        /* Профиль */
        .user-menu {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .user-name {
            color: #ddd;
        }
        
        /* Адаптивность */
        @media (max-width: 768px) {
            .navbar-content {
                flex-direction: column;
                gap: 15px;
            }
            
            .nav-menu {
                flex-direction: column;
                width: 100%;
            }
            
            .dropdown-content {
                position: static;
                box-shadow: none;
            }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="navbar-content">
            <a href="{{ route('dashboard') }}" class="logo">
                Storage of Things
            </a>
            
            @auth
            <ul class="nav-menu">
                <li><a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Главная</a></li>
                <li><a href="{{ route('archived.index') }}" class="nav-link {{ request()->routeIs('archived.*') ? 'active' : '' }}">Архив</a></li>
                
                <li class="dropdown">
                    <a href="#" class="nav-link {{ request()->routeIs('things.*') ? 'active' : '' }}">Вещи</a>
                    <div class="dropdown-content">
                        <a href="{{ route('things.index') }}" class="dropdown-item">Общий список</a>
                        <a href="{{ route('things.my') }}" class="dropdown-item">Мои вещи</a>
                        <a href="{{ route('things.used') }}" class="dropdown-item">Мои вещи у других</a>
                        <a href="{{ route('things.repair') }}" class="dropdown-item">В ремонте</a>
                        <a href="{{ route('things.work') }}" class="dropdown-item">В работе</a>
                        <a href="{{ route('things.borrowed') }}" class="dropdown-item">Взятые мной</a>
                        
                        @can('view-all-things')
                        <a href="{{ route('things.admin.all') }}" class="dropdown-item">Все вещи (админ)</a>
                        @endcan
                    </div>
                </li>
                
                <li><a href="{{ route('places.index') }}" class="nav-link {{ request()->routeIs('places.*') ? 'active' : '' }}">Места</a></li>
                
                <!-- Уведомления -->
                @php
                    $unreadCount = Auth::user()->unreadNotificationsCount();
                    $unreadDescCount = Auth::user()->unreadDescriptionNotificationsCount();
                    $totalUnread = $unreadCount + $unreadDescCount;
                @endphp
                
                <li class="notifications">
                    <a href="{{ route('notifications.index') }}" class="nav-link">
                        🔔
                        @if($totalUnread > 0)
                            <span class="notification-badge">{{ $totalUnread }}</span>
                        @endif
                    </a>
                </li>
                
                @canany(['admin', 'manage-places'])
                <li class="dropdown">
                    <a href="#" class="nav-link">Админ</a>
                    <div class="dropdown-content">
                        @can('view-all-things')
                        <a href="{{ route('things.admin.all') }}" class="dropdown-item">Все вещи</a>
                        @endcan
                        
                        @can('manage-places')
                        <a href="{{ route('places.create') }}" class="dropdown-item">Добавить место</a>
                        <a href="{{ route('places.index') }}" class="dropdown-item">Управление местами</a>
                        @endcan
                    </div>
                </li>
                @endcanany
            </ul>
            
            <div class="user-menu">
                <span class="user-name">{{ Auth::user()->name }}</span>
                @can('admin')
                <span style="background: #ffc107; color: #000; padding: 2px 8px; border-radius: 4px; font-size: 12px;">Admin</span>
                @endcan
                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn" style="padding: 6px 12px; font-size: 14px;">Выйти</button>
                </form>
            </div>
            @endauth
            
            @guest
            <ul class="nav-menu">
                <li><a href="{{ route('login') }}" class="nav-link">Войти</a></li>
                <li><a href="{{ route('register') }}" class="nav-link">Регистрация</a></li>
            </ul>
            @endguest
        </div>
    </div>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif
        
        @yield('content')
    </div>

    <script>
        // Pusher уведомления
        function showNotification(data, type = 'thing') {
            const notification = document.createElement('div');
            notification.className = 'pusher-notification';
            
            let title = '';
            let message = '';
            
            if (type === 'thing') {
                const isCreator = {{ Auth::id() ?? 'null' }} && data.user_id == {{ Auth::id() ?? 'null' }};
                title = isCreator ? 'Вы создали вещь!' : 'Новая вещь!';
                message = isCreator 
                    ? `Вы успешно создали вещь: "${data.thing_name}"`
                    : `${data.user_name} создал(а) вещь: "${data.thing_name}"`;
            } else if (type === 'place') {
                const isCreator = {{ Auth::id() ?? 'null' }} && data.user_id == {{ Auth::id() ?? 'null' }};
                title = isCreator ? 'Вы создали место!' : 'Новое место!';
                message = isCreator 
                    ? `Вы создали место: "${data.place_name}"`
                    : `${data.user_name} создал(а) место: "${data.place_name}"`;
            }
            
            notification.innerHTML = `
                <div style="margin-bottom: 10px;">
                    <strong>${title}</strong>
                </div>
                <div style="margin-bottom: 10px;">${message}</div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <small>${data.time || 'Только что'}</small>
                    <a href="${data.url}" class="btn" style="padding: 4px 8px; font-size: 12px;">Посмотреть</a>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.classList.add('fade-out');
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.parentNode.removeChild(notification);
                    }
                }, 500);
            }, 5000);
        }
        
        // Инициализация Pusher
        const pusherConfig = {
            key: '{{ env("PUSHER_APP_KEY") }}',
            cluster: '{{ env("PUSHER_APP_CLUSTER") }}'
        };
        
        if (pusherConfig.key && pusherConfig.key !== 'null') {
            // Инициализируйте Pusher здесь, если он подключен
            console.log('Pusher ready');
        }
    </script>
    
    @stack('scripts')
</body>
</html>