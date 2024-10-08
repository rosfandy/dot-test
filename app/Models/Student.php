<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'password', 'room_id'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
