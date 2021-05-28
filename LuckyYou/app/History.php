<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
//use App\Traits\Notifiable;

class History extends Model
{
    use Notifiable;
    protected $fillable = [
        'winner', 'gol', 'user_id',
    ];
}
