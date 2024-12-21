<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeUser extends Model
{
    use HasFactory;
    protected $table = 'type_users';
    protected $primaryKey = 'type_id';
    protected $fillable = [
        'type_name',
    ];
    public $timestamps = false;
    public function hasUser(){
        return this->hasMany(User::class, 'type_id');
    }
}
