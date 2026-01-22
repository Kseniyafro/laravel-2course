<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $thing->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .content-wrapper {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }
        
        @media (max-width: 768px) {
            .content-wrapper {
                grid-template-columns: 1fr;
            }
        }
        
        /* Основная карточка вещи */
        .thing-card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        
        .thing-header {
            padding: 20px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }
        
        .thing-name {
            margin: 0;
            font-size: 24px;
        }
        
        .thing-body {
            padding: 20px;
        }
        
        .thing-info {
            margin-bottom: 25px;
        }
        
        .info-row {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        
        .info-label {
            font-weight: bold;
            color: #555;
            display: block;
            margin-bottom: 5px;
        }
        
        .usage-status {
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 25px;
        }
        
        .status-in-use {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
        }
        
        .status-available {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }
        
        .thing-footer {
            padding: 20px;
            background-color: #f8f9fa;
            border-top: 1px solid #ddd;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        .btn {
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            display: inline-block;
        }
        
        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }
        
        .btn-primary {
            background-color: #007bff;
            color: white;
        }
        
        .btn-warning {
            background-color: #ffc107;
            color: #000;
        }
        
        .btn-danger {
            background-color: #dc3545;
            color: white;
        }
        
        .btn:hover {
            opacity: 0.9;
        }
        
        /* История описаний */
        .descriptions-card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        
        .descriptions-header {
            padding: 20px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #ddd;
        }
        
        .descriptions-body {
            padding: 20px;
        }
        
        .description-list {
            margin-bottom: 25px;
        }
        
        .description-item {
            padding: 15px;
            border: 1px solid #eee;
            border-radius: 4px;
            margin-bottom: 15px;
            background-color: white;
        }
        
        .description-item.current {
            border-left: 4px solid #007bff;
            background-color: #f8f9fa;
        }
        
        .description-text {
            margin-bottom: 10px;
            line-height: 1.6;
        }
        
        .description-meta {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
        }
        
        .description-actions {
            display: flex;
            gap: 10px;
        }
        
        .btn-sm {
            padding: 6px 12px;
            font-size: 14px;
        }
        
        .current-badge {
            background-color: #28a745;
            color: white;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 12px;
            margin-left: 10px;
        }
        
        .new-description-form {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 20px;
        }
        
        .form-label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }
        
        .form-input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }
        
        textarea.form-input {
            min-height: 100px;
            resize: vertical;
        }
        
        .form-hint {
            color: #666;
            font-size: 14px;
            margin-bottom: 15px;
        }
        
        /* Боковая панель */
        .sidebar {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        
        .sidebar-card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        
        .warranty-card {
            border-color: #17a2b8;
        }
        
        .sidebar-header {
            padding: 15px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #ddd;
        }
        
        .sidebar-body {
            padding: 20px;
        }
        
        .warranty-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: bold;
            margin-top: 10px;
        }
        
        .badge-good {
            background-color: #28a745;
            color: white;
        }
        
        .badge-warning {
            background-color: #ffc107;
            color: #000;
        }
        
        .badge-danger {
            background-color: #dc3545;
            color: white;
        }
        
        /* Модальные окна */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }
        
        .modal-content {
            background-color: white;
            margin: 50px auto;
            padding: 0;
            border-radius: 4px;
            max-width: 500px;
            position: relative;
        }
        
        .modal-header {
            padding: 20px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .modal-body {
            padding: 20px;
        }
        
        .modal-footer {
            padding: 20px;
            background-color: #f8f9fa;
            border-top: 1px solid #ddd;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }
        
        .close {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #666;
        }
        
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #666;
        }
        
        .return-form {
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content-wrapper">
            <!-- Основной контент -->
            <div>
                <!-- Основная информация о вещи -->
                <div class="thing-card">
                    <div class="thing-header">
                        <h2 class="thing-name">{{ $thing->name }}</h2>
                        @can('update', $thing)
                            <a href="{{ route('things.edit', $thing) }}" class="btn btn-warning">
                                Редактировать
                            </a>
                        @endcan
                    </div>
                    
                    <div class="thing-body">
                        <div class="thing-info">
                            @php
                                $currentDesc = $thing->descriptions->where('is_current', true)->first();
                            @endphp
                            
                            <div class="info-row">
                                <span class="info-label">Текущее описание:</span>
                                {{ $currentDesc ? $currentDesc->description : ($thing->description ?? 'Нет описания') }}
                            </div>
                            
                            <div class="info-row">
                                <span class="info-label">Владелец:</span>
                                {{ $thing->owner->name }}
                            </div>
                        </div>
                        
                        @if($currentUsage)
                            <div class="usage-status status-in-use">
                                <h4>Текущее использование</h4>
                                <div class="info-row">
                                    <span class="info-label">Пользователь:</span>
                                    {{ $currentUsage->user->name }}
                                </div>
                                
                                <div class="info-row">
                                    <span class="info-label">Место хранения:</span>
                                    {{ $currentUsage->place->name }}
                                </div>
                                
                                <div class="info-row">
                                    <span class="info-label">Количество:</span>
                                    @if($currentUsage->unit)
                                        {{ $currentUsage->amount }} {{ $currentUsage->unit->abbreviation }}
                                    @else
                                        {{ $currentUsage->amount }} шт.
                                    @endif
                                </div>
                                
                                <div class="info-row" style="border-bottom: none;">
                                    <span class="info-label">С:</span>
                                    {{ $currentUsage->created_at->format('d.m.Y H:i') }}
                                </div>
                                
                                @if($thing->master == Auth::id())
                                    <div class="return-form">
                                        <form action="{{ route('things.return', $thing) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">
                                                Вернуть вещь
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="usage-status status-available">
                                Вещь доступна для передачи
                            </div>
                        @endif
                    </div>
                    
                    <div class="thing-footer">
                        <a href="{{ route('things.index') }}" class="btn btn-secondary">
                            Назад к списку
                        </a>
                        
                        @if($thing->master == Auth::id() && !$currentUsage)
                            <button type="button" class="btn btn-primary" onclick="openTransferModal()">
                                Передать вещь
                            </button>
                        @endif
                    </div>
                </div>

                <!-- История описаний -->
                <div class="descriptions-card">
                    <div class="descriptions-header">
                        <h3>История описаний</h3>
                    </div>
                    
                    <div class="descriptions-body">
                        @if($thing->descriptions->count() > 0)
                            <div class="description-list">
                                @foreach($thing->descriptions as $desc)
                                    <div class="description-item {{ $desc->is_current ? 'current' : '' }}">
                                        <div class="description-text">
                                            {{ $desc->description }}
                                        </div>
                                        
                                        <div class="description-meta">
                                            {{ $desc->creator->name }} | {{ $desc->created_at->format('d.m.Y H:i') }}
                                            @if($desc->is_current)
                                                <span class="current-badge">Текущее</span>
                                            @endif
                                        </div>
                                        
                                        @can('update', $thing)
                                            <div class="description-actions">
                                                @if(!$desc->is_current)
                                                    <form action="{{ route('things.set-current-description', ['thing' => $thing, 'description' => $desc]) }}" 
                                                          method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary btn-sm">
                                                            Сделать текущим
                                                        </button>
                                                    </form>
                                                @endif
                                                
                                                <button type="button" class="btn btn-warning btn-sm edit-description-btn" 
                                                        onclick="openEditDescriptionModal({{ $desc->id }}, '{{ addslashes($desc->description) }}')">
                                                    Редактировать
                                                </button>
                                            </div>
                                        @endcan
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                Нет сохраненных описаний
                            </div>
                        @endif

                        @can('update', $thing)
                            <div class="new-description-form">
                                <h4>Добавить новое описание</h4>
                                <form action="{{ route('things.add-description', $thing) }}" method="POST">
                                    @csrf
                                    <label class="form-label">Текст описания</label>
                                    <textarea class="form-input" name="description" 
                                              rows="3" placeholder="Введите новое описание..." required></textarea>
                                    <div class="form-hint">
                                        Новое описание станет текущим. Будет отправлено уведомление владельцу и назначенному пользователю.
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        Добавить описание
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Боковая панель -->
            <div class="sidebar">
                <!-- Блок гарантии -->
                @if($thing->wrnt)
                <div class="sidebar-card warranty-card">
                    <div class="sidebar-header">
                        <h3>Гарантия/срок годности</h3>
                    </div>
                    <div class="sidebar-body">
                        <div style="margin-bottom: 15px;">
                            <strong>До:</strong> {{ $thing->wrnt->format('d.m.Y') }}
                        </div>
                        @php
                            $daysLeft = now()->diffInDays($thing->wrnt, false);
                        @endphp
                        @if($daysLeft > 30)
                            <span class="warranty-badge badge-good">
                                Осталось дней: {{ $daysLeft }}
                            </span>
                        @elseif($daysLeft > 0)
                            <span class="warranty-badge badge-warning">
                                Осталось дней: {{ $daysLeft }}
                            </span>
                        @else
                            <span class="warranty-badge badge-danger">
                                Гарантия истекла
                            </span>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Модальное окно для передачи вещи -->
    @if($thing->master == Auth::id() && !$currentUsage)
    <div id="transferModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Передать вещь в пользование</h3>
                <button class="close" onclick="closeTransferModal()">&times;</button>
            </div>
            
            <form action="{{ route('things.transfer', $thing) }}" method="POST">
                @csrf
                
                <div class="modal-body">
                    <div style="margin-bottom: 20px;">
                        <label class="form-label">Пользователь</label>
                        <select name="user_id" class="form-input" required>
                            <option value="">Выберите пользователя</option>
                            @foreach(\App\Models\User::where('id', '!=', Auth::id())->get() as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div style="margin-bottom: 20px;">
                        <label class="form-label">Место хранения</label>
                        <select name="place_id" class="form-input" required>
                            <option value="">Выберите место</option>
                            @foreach(\App\Models\Place::where('repair', false)
                                ->where('work', false)
                                ->get() as $place)
                                <option value="{{ $place->id }}">{{ $place->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div style="margin-bottom: 20px;">
                        <label class="form-label">Количество</label>
                        <input type="number" name="amount" class="form-input" value="1" min="1" required>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeTransferModal()">Отмена</button>
                    <button type="submit" class="btn btn-primary">Передать</button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <!-- Модальное окно для редактирования описания -->
    @can('update', $thing)
    <div id="editDescriptionModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Редактировать описание</h3>
                <button class="close" onclick="closeEditDescriptionModal()">&times;</button>
            </div>
            
            <form id="editDescriptionForm" method="POST">
                @csrf
                @method('PUT')
                
                <div class="modal-body">
                    <input type="hidden" id="editDescriptionId" name="description_id">
                    <label class="form-label">Текст описания</label>
                    <textarea class="form-input" id="editDescriptionText" name="new_description" 
                              rows="4" required></textarea>
                    <div class="form-hint">
                        После сохранения будет отправлено уведомление владельцу и назначенному пользователю.
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeEditDescriptionModal()">Отмена</button>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
    @endcan

    <script>
        // Функции для модального окна передачи
        function openTransferModal() {
            document.getElementById('transferModal').style.display = 'block';
        }
        
        function closeTransferModal() {
            document.getElementById('transferModal').style.display = 'none';
        }
        
        // Функции для модального окна редактирования описания
        function openEditDescriptionModal(id, text) {
            document.getElementById('editDescriptionId').value = id;
            document.getElementById('editDescriptionText').value = text;
            document.getElementById('editDescriptionForm').action = `/things/{{ $thing->id }}/update-description/${id}`;
            document.getElementById('editDescriptionModal').style.display = 'block';
        }
        
        function closeEditDescriptionModal() {
            document.getElementById('editDescriptionModal').style.display = 'none';
        }
        
        // Закрытие модальных окон при клике вне их
        window.onclick = function(event) {
            const transferModal = document.getElementById('transferModal');
            const editModal = document.getElementById('editDescriptionModal');
            
            if (event.target === transferModal) {
                closeTransferModal();
            }
            if (event.target === editModal) {
                closeEditDescriptionModal();
            }
        }
        
        // Обработка отправки формы редактирования описания
        document.addEventListener('DOMContentLoaded', function() {
            const editForm = document.getElementById('editDescriptionForm');
            
            if (editForm) {
                editForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const formData = new FormData(this);
                    const submitButton = this.querySelector('button[type="submit"]');
                    const originalText = submitButton.innerHTML;
                    
                    submitButton.innerHTML = 'Сохранение...';
                    submitButton.disabled = true;
                    
                    fetch(this.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            closeEditDescriptionModal();
                            setTimeout(() => {
                                window.location.reload();
                            }, 500);
                        } else {
                            alert(data.message || 'Ошибка при сохранении');
                            submitButton.innerHTML = originalText;
                            submitButton.disabled = false;
                        }
                    })
                    .catch(error => {
                        console.error('Ошибка:', error);
                        alert('Ошибка при сохранении описания');
                        submitButton.innerHTML = originalText;
                        submitButton.disabled = false;
                    });
                });
            }
        });
    </script>
</body>
</html>