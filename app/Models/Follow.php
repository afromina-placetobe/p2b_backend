<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $primaryKey = 'follow_id';
    protected $table = 'follow';
    protected $fillable = [
        'follow_id',
        'follower_id',
        'followed_id'
    ];
}
