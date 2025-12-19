<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewArticleNotify extends Notification
{
    use Queueable;

    public function __construct(public string $article_title, public int $article_id)
    {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'article' => $this->article_title,
            'article_id' => $this->article_id,
        ];
    }
}


