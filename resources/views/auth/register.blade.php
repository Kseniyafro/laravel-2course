<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .register-container {
            width: 100%;
            max-width: 450px;
        }
        
        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .register-header h1 {
            color: #333;
            font-size: 28px;
            margin-bottom: 10px;
        }
        
        .register-header p {
            color: #666;
            font-size: 16px;
        }
        
        .register-form {
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
        }
        
        .form-input {
            width: 100%;
            padding: 14px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
            transition: border-color 0.2s;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #007bff;
        }
        
        .input-error {
            border-color: #ff4444;
        }
        
        .error-message {
            color: #ff4444;
            font-size: 14px;
            margin-top: 5px;
            display: block;
        }
        
        .submit-button {
            width: 100%;
            padding: 14px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
            margin-top: 10px;
        }
        
        .submit-button:hover {
            background-color: #0056cc;
        }
        
        .form-footer {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        
        .login-link {
            color: #007bff;
            text-decoration: none;
            font-size: 15px;
        }
        
        .login-link:hover {
            text-decoration: underline;
        }
        
        @media (max-width: 480px) {
            .register-form {
                padding: 20px;
            }
            
            .register-header h1 {
                font-size: 24px;
            }
            
            .form-input {
                padding: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <h1>Создание аккаунта</h1>
            <p>Заполните форму для регистрации</p>
        </div>
        
        <div class="register-form">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <div class="form-group">
                    <label for="name" class="form-label">Имя</label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           class="form-input {{ $errors->has('name') ? 'input-error' : '' }}"
                           value="{{ old('name') }}" 
                           required 
                           autofocus>
                    @if($errors->has('name'))
                        <span class="error-message">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           class="form-input {{ $errors->has('email') ? 'input-error' : '' }}"
                           value="{{ old('email') }}" 
                           required>
                    @if($errors->has('email'))
                        <span class="error-message">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                
                <div class="form-group">
                    <label for="password" class="form-label">Пароль</label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           class="form-input {{ $errors->has('password') ? 'input-error' : '' }}"
                           required>
                    @if($errors->has('password'))
                        <span class="error-message">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Подтвердите пароль</label>
                    <input type="password" 
                           id="password_confirmation" 
                           name="password_confirmation" 
                           class="form-input"
                           required>
                </div>
                
                <button type="submit" class="submit-button">
                    Зарегистрироваться
                </button>
                
                <div class="form-footer">
                    <a href="{{ route('login') }}" class="login-link">
                        Уже есть аккаунт? Войти
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
