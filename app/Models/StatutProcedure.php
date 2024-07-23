<?php

namespace App\Models;

use App\Models\Procedure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatutProcedure extends Model
{
    use HasFactory;
  
    protected $table = 'statut_procedure';
    protected $guarded = [];

    public function procedures(): HasMany
    {
        return $this->hasMany(Procedure::class);
    }
    
}
