<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function createLog ($activity , $description){
        self::create([
            'name'=> auth()->user()->name,
            'activity'=> $activity,
            'description'=> $description,
            'time'=> now()
        ]);
    }
}
