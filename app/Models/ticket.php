<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'ticket_id', 'event_id', 'price'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
