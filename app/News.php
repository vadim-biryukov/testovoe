<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class News extends Model
{
    use Notifiable;

    protected $fillable = [
        'header','text','img','sorting','day_news','news_types_id'
    ];
}
