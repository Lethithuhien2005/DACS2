<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $primaryKey = 'category_id';
    protected $fillable = [
        'category_name',
        'category_desc',
    ];
    public $timestamps = false;
    public function hasDishs() {
        return $this->hasMany(Dish::class, 'category_id');
    }
}
