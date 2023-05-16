<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'Name','Email'
    ];
    public function user(){
        return $this->belongsTo(User::class, 'id' ,'user_id');
    }

}
