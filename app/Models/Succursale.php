<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Succursale extends Model
{
    use HasFactory;

    protected $table = "succursale";
    protected $guarded = [];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'id_succursale');
    }

}
