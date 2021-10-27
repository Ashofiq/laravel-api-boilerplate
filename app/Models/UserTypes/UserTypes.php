<?php

namespace App\Models\UserTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTypes extends Model
{   
    use HasFactory;
    const ACTIVE = 'active';
    const BLOCK   = 'block';

    protected $table = 'user_types';

    protected $fillable = [
        'user_id',
        'type',
        'status'
    ];
   

    public function addType($data){
        return static::create($data);
    }
}
