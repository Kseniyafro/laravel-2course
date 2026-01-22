<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить место хранения</title>
</head>
<body style="font-family: Arial; max-width: 600px; margin: 0 auto; padding: 20px;">
    <h1 style="border-bottom: 2px solid #007bff; padding-bottom: 10px;">
        Добавить новое место хранения
    </h1>
    
    <form method="POST" action="{{ route('places.store') }}" style="margin-top: 30px;">
        @csrf
        
        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">
                Название *
            </label>
            <input type="text" 
                   name="name" 
                   value="{{ old('name') }}" 
                   required
                   autofocus
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
            @if($errors->has('name'))
                <div style="color: #dc3545; font-size: 14px; margin-top: 5px;">
                    {{ $errors->first('name') }}
                </div>
            @endif
        </div>
        
        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">
                Описание
            </label>
            <textarea name="description" 
                      rows="4"
                      style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                {{ old('description') }}
            </textarea>
        </div>
        
        <div style="margin: 20px 0;">
            <div style="margin-bottom: 15px;">
                <label style="display: flex; align-items: center;">
                    <input type="checkbox" name="repair" value="1" {{ old('repair') ? 'checked' : '' }}
                           style="margin-right: 10px;">
                    <div>
                        <strong>Место на ремонте/мойке</strong>
                        <div style="color: #666; font-size: 14px;">
                            Вещи будут отмечены красным цветом
                        </div>
                    </div>
                </label>
            </div>
            
            <div>
                <label style="display: flex; align-items: center;">
                    <input type="checkbox" name="work" value="1" {{ old('work') ? 'checked' : '' }}
                           style="margin-right: 10px;">
                    <div>
                        <strong>Место в работе</strong>
                        <div style="color: #666; font-size: 14px;">
                            Вещи будут отмечены оранжевым цветом
                        </div>
                    </div>
                </label>
            </div>
        </div>
        
        <div style="background: #f0f8ff; border: 1px solid #b8daff; padding: 15px; margin: 20px 0; border-radius: 4px;">
            <strong>Важно:</strong> Вещи получат цветовое выделение в списке
        </div>
        
        <div style="margin-top: 30px; display: flex; justify-content: space-between;">
            <a href="{{ route('places.index') }}" 
               style="background: #6c757d; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px;">
                Назад
            </a>
            
            <button type="submit" 
                    style="background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">
                Сохранить
            </button>
        </div>
    </form>
</body>
</html>
