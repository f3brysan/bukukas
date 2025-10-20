<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name', 'type', 'created_at', 'updated_at'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
