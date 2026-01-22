@extends('layouts.app')

@section('title', 'Архив удаленных вещей')

@section('content')
<div class="container py-4">
    <div class="mb-4">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h1>Архив удаленных вещей</h1>
            <a href="{{ route('things.index') }}" class="btn btn-outline-secondary">
                ← Назад к вещам
            </a>
        </div>
        <p class="text-muted">Здесь хранятся удаленные вещи. Вы можете восстановить их или полностью удалить.</p>
    </div>

    @if($archivedThings->count() > 0)
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; border: 1px solid #ddd;">
                <thead style="background-color: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                    <tr>
                        <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Название</th>
                        <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Владелец</th>
                        <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Место</th>
                        <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Кол-во</th>
                        <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Удалена</th>
                        <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Статус</th>
                        <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($archivedThings as $archived)
                        <tr style="background-color: {{ $archived->restored ? '#d4edda' : '#fff' }}; border-bottom: 1px solid #dee2e6;">
                            <td style="padding: 12px; border-bottom: 1px solid #ddd;">
                                <div style="font-weight: bold; margin-bottom: 4px;">{{ $archived->name }}</div>
                                @if($archived->description)
                                    <div style="font-size: 0.9em; color: #666;">{{ Str::limit($archived->description, 40) }}</div>
                                @endif
                            </td>
                            <td style="padding: 12px; border-bottom: 1px solid #ddd;">
                                <div>{{ $archived->owner_name }}</div>
                                <div style="font-size: 0.85em; color: #666;">{{ $archived->owner_email }}</div>
                            </td>
                            <td style="padding: 12px; border-bottom: 1px solid #ddd;">
                                {{ $archived->place_full }}
                            </td>
                            <td style="padding: 12px; border-bottom: 1px solid #ddd;">
                                {{ $archived->formatted_amount }}
                            </td>
                            <td style="padding: 12px; border-bottom: 1px solid #ddd;">
                                {{ $archived->formatted_deleted_at }}
                            </td>
                            <td style="padding: 12px; border-bottom: 1px solid #ddd;">
                                @if($archived->restored)
                                    <span style="display: inline-block; padding: 4px 8px; background-color: #28a745; color: white; border-radius: 4px; font-size: 0.85em;">
                                        Восстановлена
                                    </span>
                                    <div style="font-size: 0.85em; color: #666; margin-top: 4px;">
                                        {{ $archived->formatted_restored_at }}
                                    </div>
                                @else
                                    <span style="display: inline-block; padding: 4px 8px; background-color: #ffc107; color: #212529; border-radius: 4px; font-size: 0.85em;">
                                        В архиве
                                    </span>
                                @endif
                            </td>
                            <td style="padding: 12px; border-bottom: 1px solid #ddd;">
                                <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                                    <a href="{{ route('archived.show', $archived) }}" 
                                       class="btn btn-outline-primary" 
                                       style="padding: 6px 12px; font-size: 0.875rem; border-radius: 4px; text-decoration: none; border: 1px solid #007bff; color: #007bff; background: white;">
                                        Просмотр
                                    </a>
                                    
                                    @if(!$archived->restored)
                                        <form action="{{ route('archived.restore', $archived) }}" 
                                              method="POST" style="margin: 0;">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-success"
                                                    style="padding: 6px 12px; font-size: 0.875rem; border-radius: 4px; border: 1px solid #28a745; color: #28a745; background: white; cursor: pointer;"
                                                    onclick="return confirm('Восстановить эту вещь? Вы станете ее новым владельцем.')">
                                                Восстановить
                                            </button>
                                        </form>
                                    @endif
                                    
                                    @can('admin')
                                    <form action="{{ route('archived.force-delete', $archived) }}" 
                                          method="POST" style="margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger"
                                                style="padding: 6px 12px; font-size: 0.875rem; border-radius: 4px; border: 1px solid #dc3545; color: #dc3545; background: white; cursor: pointer;"
                                                onclick="return confirm('Удалить эту запись из архива навсегда? Это действие нельзя отменить.')">
                                            Удалить
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($archivedThings->hasPages())
            <div style="margin-top: 24px; display: flex; justify-content: center;">
                <div style="display: flex; gap: 8px;">
                    @if($archivedThings->onFirstPage())
                        <span style="padding: 8px 16px; background-color: #e9ecef; color: #6c757d; border-radius: 4px;">← Назад</span>
                    @else
                        <a href="{{ $archivedThings->previousPageUrl() }}" 
                           style="padding: 8px 16px; background-color: #007bff; color: white; border-radius: 4px; text-decoration: none;">← Назад</a>
                    @endif

                    @foreach(range(1, $archivedThings->lastPage()) as $page)
                        @if($page == $archivedThings->currentPage())
                            <span style="padding: 8px 16px; background-color: #007bff; color: white; border-radius: 4px; font-weight: bold;">{{ $page }}</span>
                        @else
                            <a href="{{ $archivedThings->url($page) }}" 
                               style="padding: 8px 16px; background-color: #f8f9fa; color: #007bff; border-radius: 4px; text-decoration: none; border: 1px solid #dee2e6;">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if($archivedThings->hasMorePages())
                        <a href="{{ $archivedThings->nextPageUrl() }}" 
                           style="padding: 8px 16px; background-color: #007bff; color: white; border-radius: 4px; text-decoration: none;">Далее →</a>
                    @else
                        <span style="padding: 8px 16px; background-color: #e9ecef; color: #6c757d; border-radius: 4px;">Далее →</span>
                    @endif
                </div>
            </div>
        @endif
    @else
        <div style="padding: 20px; background-color: #e7f3fe; border: 1px solid #b8daff; border-radius: 4px; color: #004085;">
            <div style="display: flex; align-items: center; gap: 10px;">
                <span style="font-size: 1.2em;">ℹ️</span>
                <div>
                    <strong>Архив пуст</strong><br>
                    Здесь будут появляться удаленные вещи
                </div>
            </div>
        </div>
    @endif
</div>
@endsection