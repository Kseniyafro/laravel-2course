@php
    // Старые уведомления (для назначения вещей)
    $unreadCount = Auth::user()->unreadNotificationsCount();
    $notifications = Auth::user()->notifications()->latest()->limit(5)->get();
    
    // Новые уведомления (для описаний)
    $unreadDescCount = Auth::user()->unreadDescriptionNotificationsCount();
    $descNotifications = Auth::user()->descriptionNotifications()->latest()->limit(5)->get();
    
    // Общее количество
    $totalUnread = $unreadCount + $unreadDescCount;
@endphp

<li style="position: relative; display: inline-block;">
    <a href="#" 
       style="display: block; padding: 10px; color: #333; text-decoration: none; position: relative;"
       onclick="document.getElementById('notificationsDropdown').style.display = 
                document.getElementById('notificationsDropdown').style.display === 'block' ? 'none' : 'block';
                return false;">
        <span style="font-size: 18px;">🔔</span>
        @if($totalUnread > 0)
            <span style="position: absolute; top: 5px; right: 5px; background: #dc3545; color: white; 
                   border-radius: 50%; width: 18px; height: 18px; font-size: 11px; 
                   display: flex; align-items: center; justify-content: center;">
                {{ $totalUnread }}
            </span>
        @endif
    </a>
    
    <div id="notificationsDropdown" 
         style="display: none; position: absolute; right: 0; top: 100%; 
                background: white; border: 1px solid #ddd; border-radius: 4px; 
                box-shadow: 0 2px 10px rgba(0,0,0,0.1); width: 320px; z-index: 1000;">
        
        <div style="padding: 12px 16px; background: #f8f9fa; border-bottom: 1px solid #ddd;">
            <strong>Уведомления</strong>
        </div>
        
        <div style="max-height: 400px; overflow-y: auto;">
            @if($notifications->count() > 0 || $descNotifications->count() > 0)
                @foreach($notifications as $notification)
                    <div style="padding: 12px 16px; border-bottom: 1px solid #eee;">
                        <a href="{{ route('notifications.show', $notification) }}"
                           style="color: #333; text-decoration: none; display: block;">
                            <div style="{{ !$notification->read ? 'font-weight: bold;' : '' }} 
                                        margin-bottom: 4px;">
                                {{ $notification->title }}
                            </div>
                            <div style="color: #666; font-size: 13px; margin-bottom: 4px;">
                                {{ \Illuminate\Support\Str::limit($notification->message, 50) }}
                            </div>
                            <div style="color: #999; font-size: 12px;">
                                {{ $notification->created_at->diffForHumans() }}
                            </div>
                        </a>
                    </div>
                @endforeach
                
                @foreach($descNotifications as $notification)
                    <div style="padding: 12px 16px; border-bottom: 1px solid #eee;">
                        <a href="{{ route('things.show', $notification->thing) }}"
                           style="color: #333; text-decoration: none; display: block;">
                            <div style="{{ !$notification->read ? 'font-weight: bold;' : '' }} 
                                        margin-bottom: 4px;">
                                {{ $notification->title }}
                            </div>
                            <div style="color: #666; font-size: 13px; margin-bottom: 4px;">
                                {{ \Illuminate\Support\Str::limit($notification->message, 50) }}
                            </div>
                            <div style="color: #999; font-size: 12px;">
                                {{ $notification->created_at->diffForHumans() }}
                            </div>
                        </a>
                    </div>
                @endforeach
            @else
                <div style="padding: 20px; text-align: center; color: #666;">
                    Нет новых уведомлений
                </div>
            @endif
        </div>
        
        <div style="padding: 12px 16px; border-top: 1px solid #ddd; text-align: center;">
            <a href="{{ route('notifications.index') }}"
               style="color: #007bff; text-decoration: none; font-size: 14px;">
                Показать все уведомления →
            </a>
        </div>
    </div>
</li>

<script>
document.addEventListener('click', function(event) {
    var dropdown = document.getElementById('notificationsDropdown');
    var trigger = event.target.closest('a[onclick*="notificationsDropdown"]');
    
    if (!dropdown.contains(event.target) && !trigger) {
        dropdown.style.display = 'none';
    }
});
</script>