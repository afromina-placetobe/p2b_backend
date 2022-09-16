<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $table = 'events';
    protected $fillable = [
        'event_id',
        'event_status',
        'userId',
        'event_image',
        'event_name',
        'event_description',
        'start_date',
        'start_time',
        'end_date',
        'end_time',
        'category',
        'event_organizer',
        'event_venue',
        'event_address',
        'address_latitude',
        'address_longitude',
        'contact_phone',
        'redirectUrl',
        'event_entrance_fee'
    ];
}
