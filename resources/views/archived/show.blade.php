@extends('layouts.app')

@section('title', 'Архив: ' . $archivedThing->name)

@section('content')
<div style="max-width: 1200px; margin: 0 auto; padding: 20px;">
    <!-- Заголовок -->
    <div style="margin-bottom: 20px;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h1 style="margin: 0;">
                Архив: {{ $archivedThing->name }}
                @if($archivedThing->restored)
                    <span style="display: inline-block; padding: 4px 12px; background-color: #28a745; color: white; border-radius: 4px; font-size: 0.8em; margin-left: 10px;">
                        Восстановлена
                    </span>
                @endif
            </h1>
            <a href="{{ route('archived.index') }}" style="padding: 8px 16px; background-color: #6c757d; color: white; border-radius: 4px; text-decoration: none;">
                Назад к архиву
            </a>
        </div>
    </div>

    <div style="display: flex; flex-wrap: wrap; gap: 20px;">
        <!-- Основная информация -->
        <div style="flex: 2; min-width: 300px;">
            <div style="background: white; border: 1px solid #ddd; border-radius: 4px; overflow: hidden;">
                <!-- Шапка карточки -->
                <div style="padding: 15px 20px; background-color: {{ $archivedThing->restored ? '#28a745' : '#ffc107' }}; color: {{ $archivedThing->restored ? 'white' : '#212529' }};">
                    <h3 style="margin: 0;">Детали архива</h3>
                </div>
                
                <!-- Тело карточки -->
                <div style="padding: 20px;">
                    <!-- Основная информация -->
                    <div style="margin-bottom: 20px;">
                        <h4 style="margin-top: 0; margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px solid #eee;">Основная информация</h4>
                        <div style="display: flex; flex-wrap: wrap; gap: 20px;">
                            <div style="flex: 1; min-width: 250px;">
                                <p style="margin: 8px 0;">
                                    <strong>Название:</strong><br>
                                    {{ $archivedThing->name }}
                                </p>
                                <p style="margin: 8px 0;">
                                    <strong>Описание:</strong><br>
                                    {{ $archivedThing->description ?? 'Нет описания' }}
                                </p>
                            </div>
                            <div style="flex: 1; min-width: 250px;">
                                <p style="margin: 8px 0;">
                                    <strong>Количество:</strong><br>
                                    {{ $archivedThing->formatted_amount }}
                                </p>
                                <p style="margin: 8px 0;">
                                    <strong>Гарантия до:</strong><br>
                                    {{ $archivedThing->wrnt ? $archivedThing->wrnt->format('d.m.Y') : 'Нет гарантии' }}
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Владелец и пользователи -->
                    <div style="margin-bottom: 20px;">
                        <div style="display: flex; flex-wrap: wrap; gap: 20px;">
                            <div style="flex: 1; min-width: 250px;">
                                <h4 style="margin-top: 0; margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px solid #eee;">Владелец</h4>
                                <p style="margin: 8px 0;">
                                    <strong>Имя:</strong><br>
                                    {{ $archivedThing->owner_name }}
                                </p>
                                <p style="margin: 8px 0;">
                                    <strong>Email:</strong><br>
                                    {{ $archivedThing->owner_email }}
                                </p>
                            </div>
                            
                            @if($archivedThing->last_user_name)
                            <div style="flex: 1; min-width: 250px;">
                                <h4 style="margin-top: 0; margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px solid #eee;">Последний пользователь</h4>
                                <p style="margin: 8px 0;">
                                    <strong>Имя:</strong><br>
                                    {{ $archivedThing->last_user_name }}
                                </p>
                                <p style="margin: 8px 0;">
                                    <strong>Email:</strong><br>
                                    {{ $archivedThing->last_user_email }}
                                </p>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Место хранения -->
                    <div style="margin-bottom: 20px;">
                        <h4 style="margin-top: 0; margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px solid #eee;">Место хранения</h4>
                        <div style="display: flex; flex-wrap: wrap; gap: 20px;">
                            <div style="flex: 1; min-width: 250px;">
                                <p style="margin: 8px 0;">
                                    <strong>Название:</strong><br>
                                    {{ $archivedThing->place_name ?? 'Не указано' }}
                                </p>
                            </div>
                            <div style="flex: 1; min-width: 250px;">
                                <p style="margin: 8px 0;">
                                    <strong>Описание:</strong><br>
                                    {{ $archivedThing->place_description ?? 'Нет описания' }}
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Даты -->
                    <div style="margin-bottom: 20px;">
                        <h4 style="margin-top: 0; margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px solid #eee;">Даты</h4>
                        <div style="display: flex; flex-wrap: wrap; gap: 20px;">
                            <div style="flex: 1; min-width: 250px;">
                                <p style="margin: 8px 0;">
                                    <strong>Удалена:</strong><br>
                                    {{ $archivedThing->formatted_deleted_at }}
                                </p>
                            </div>
                            @if($archivedThing->restored)
                            <div style="flex: 1; min-width: 250px;">
                                <p style="margin: 8px 0;">
                                    <strong>Восстановлена:</strong><br>
                                    {{ $archivedThing->formatted_restored_at }}
                                </p>
                                <p style="margin: 8px 0;">
                                    <strong>Кем:</strong><br>
                                    {{ $archivedThing->restored_by_name }}
                                </p>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Техническая информация -->
                    @if($archivedThing->metadata)
                    <div>
                        <h4 style="margin-top: 0; margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px solid #eee;">Техническая информация</h4>
                        <div style="background-color: #f8f9fa; border: 1px solid #ddd; padding: 15px; border-radius: 4px; overflow: auto;">
                            <pre style="margin: 0; font-size: 12px; line-height: 1.4;">{{ json_encode($archivedThing->metadata, JSON_PRETTY_PRINT) }}</pre>
                        </div>
                    </div>
                    @endif
                </div>
                
                <!-- Футер карточки -->
                <div style="padding: 15px 20px; background-color: #f8f9fa; border-top: 1px solid #ddd; display: flex; justify-content: space-between; align-items: center;">
                    <a href="{{ route('archived.index') }}" style="padding: 8px 16px; background-color: #6c757d; color: white; border-radius: 4px; text-decoration: none;">
                        ← К списку архива
                    </a>
                    
                    <div style="display: flex; gap: 10px;">
                        @if(!$archivedThing->restored)
                            <form action="{{ route('archived.restore', $archivedThing) }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" 
                                        style="padding: 8px 16px; background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer;"
                                        onclick="return confirm('Восстановить эту вещь? Вы станете ее новым владельцем.')">
                                    Восстановить
                                </button>
                            </form>
                        @endif
                        
                        @can('admin')
                            <form action="{{ route('archived.force-delete', $archivedThing) }}" method="POST" style="margin: 0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        style="padding: 8px 16px; background-color: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer;"
                                        onclick="return confirm('Удалить эту запись из архива навсегда?')">
                                    Удалить навсегда
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Боковая панель статуса -->
        <div style="flex: 1; min-width: 250px;">
            <div style="background: white; border: 1px solid #ddd; border-radius: 4px; overflow: hidden;">
                <div style="padding: 15px 20px; background-color: #17a2b8; color: white;">
                    <h3 style="margin: 0;">Статус</h3>
                </div>
                
                <div style="padding: 20px;">
                    @if($archivedThing->restored)
                        <div style="padding: 15px; background-color: #d4edda; border: 1px solid #c3e6cb; border-radius: 4px; color: #155724;">
                            <h4 style="margin-top: 0; color: #155724;">Вещь восстановлена</h4>
                            <p style="margin: 10px 0 0 0;">
                                Восстановлена: {{ $archivedThing->formatted_restored_at }}<br>
                                Новый владелец: <strong>{{ $archivedThing->restored_by_name }}</strong>
                            </p>
                        </div>
                    @else
                        <div style="padding: 15px; background-color: #fff3cd; border: 1px solid #ffeaa7; border-radius: 4px; color: #856404;">
                            <h4 style="margin-top: 0; color: #856404;">Вещь в архиве</h4>
                            <p style="margin: 10px 0 0 0;">
                                Удалена: {{ $archivedThing->formatted_deleted_at }}<br>
                                Можно восстановить
                            </p>
                        </div>
                    @endif
                    
                    <!-- Быстрые действия -->
                    <div style="margin-top: 20px; padding-top: 15px; border-top: 1px solid #eee;">
                        <h4 style="margin-top: 0; margin-bottom: 15px;">Действия</h4>
                        <div style="display: flex; flex-direction: column; gap: 10px;">
                            <a href="{{ route('archived.index') }}" 
                               style="display: block; padding: 10px; background-color: #f8f9fa; border: 1px solid #ddd; border-radius: 4px; text-decoration: none; color: #333; text-align: center;">
                                Вернуться к архиву
                            </a>
                            
                            @if(!$archivedThing->restored)
                                <form action="{{ route('archived.restore', $archivedThing) }}" method="POST" style="margin: 0;">
                                    @csrf
                                    <button type="submit" 
                                            style="width: 100%; padding: 10px; background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer;"
                                            onclick="return confirm('Восстановить вещь?')">
                                        Восстановить сейчас
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection