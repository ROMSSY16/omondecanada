<?php

namespace App\Models;

use App\Models\Procedure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeProcedure extends Model
{
    use HasFactory;

    protected $table = 'type_procedure';
    protected $guarded = [];

    public function proceduresDemandees(): HasMany
    {
        return $this->hasMany(Procedure::class);
    }
}

