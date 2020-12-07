<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class product extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'id';
    const CREATED_AT = 'date_creation';
    const UPDATED_AT = 'last_update';
    protected $fillable = [
        'name',
        'picture',
        'stock',
        'description',
        'price',
        'category'
    ];
}
