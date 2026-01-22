<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать: {{ $place->name }}</title>
</head>
<body style="font-family: Arial; max-width: 600px; margin: 0 auto; padding: 20px;">
    <h1 style="border-bottom: 2px solid #ffc107; padding-bottom: 10px;">
        Редактировать место: {{ $place->name }}
    </h1>
    
    <form method="POST" action="{{ route('places.update', $place) }}" style="margin-top: 30px;">
        @csrf
        @method('PUT')
        
        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">
                Название *
            </label>
            <input type="text" 
                   name="name" 
                   value="{{ old('name', $place->name) }}" 
                   required
                   autofocus
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
        </div>
        
        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">
                Описание
            </label>
            <textarea name="description" 
                      rows="4"
                      style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                {{ old('description', $place->description) }}
            </textarea>
        </div>
        
        <div style="margin: 20px 0;">
            <div style="margin-bottom: 15px;">
                <label style="display: flex; align-items: center;">
                    <input type="checkbox" 
                           name="repair" 
                           value="1" 
                           {{ old('repair', $place->repair) ? 'checked' : '' }}
                           style="margin-right: 10px;">
                    <div>
                        <strong>Место на ремонте/мойке</strong>
                        <div style="color: #666; font-size: 14px;">
                            Вещи будут отмечены как в ремонте
                        </div>
                    </div>
                </label>
            </div>
            
            <div>
                <label style="display: flex; align-items: center;">
                    <input type="checkbox" 
                           name="work" 
                           value="1" 
                           {{ old('work', $place->work) ? 'checked' : '' }}
                           style="margin-right: 10px;">
                    <div>
                        <strong>Место в работе</strong>
                        <div style="color: #666; font-size: 14px;">
                            Вещи будут отмечены как в работе
                        </div>
                    </div>
                </label>
            </div>
        </div>
        
        <div style="background: #f8f9fa; border: 1px solid #ddd; padding: 15px; margin: 20px 0; border-radius: 4px;">
            <strong>Статистика:</strong>
            <ul style="margin: 10px 0 0 0; padding-left: 20px;">
                <li>Вещей в этом месте: {{ $place->usages()->count() }}</li>
                <li>Создано: {{ $place->created_at->format('d.m.Y') }}</li>
            </ul>
        </div>
        
        @if($place->usages()->count() > 0)
        <div style="background: #fff3cd; border: 1px solid #ffeaa7; padding: 15px; margin: 20px 0; border-radius: 4px;">
            <strong>Внимание!</strong> Изменение статуса повлияет на отображение вещей.
        </div>
        @endif
        
        <div style="margin-top: 30px; display: flex; justify-content: space-between;">
            <a href="{{ route('places.show', $place) }}" 
               style="background: #6c757d; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px;">
                Назад
            </a>
            
            <button type="submit" 
                    style="background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">
                Сохранить
            </button>
        </div>
    </form>
    
    @can('delete', $place)
    <hr style="margin: 30px 0;">
    
    <form action="{{ route('places.destroy', $place) }}" method="POST" 
          onsubmit="return confirm('Удалить это место хранения?')">
        @csrf
        @method('DELETE')
        <button type="submit" 
                style="background: #dc3545; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">
            Удалить место
        </button>
    </form>
    @endcan
</body>
</html>