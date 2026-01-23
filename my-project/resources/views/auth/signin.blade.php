@extends('layout')
@section('content')
    <div class="auth-form">
        <h2>Регистрация</h2>
        <form action="/auth/registr" method="POST">
            @csrf
            <div class="form-group">
                <label for="name" class="form-label">Ваше имя</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Пароль (мин. 6 символов)</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Зарегистрироваться</button>
        </form>
    </div>
@endsection