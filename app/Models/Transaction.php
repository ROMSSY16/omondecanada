<?php

namespace App\Models;

use App\Models\Procedure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function procedure(): BelongsTo
    {
        return $this->belongsTo(Procedure::class, 'id_procedure', 'id');
    }
    public function modePaiement(): BelongsTo
    {
        return $this->belongsTo(ModePaiement::class, 'id_moyen_paiement', 'id');
    }
    public function agent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_agent', 'id');
    }
    public function typeProcedure(): BelongsTo
    {
        return $this->belongsTo(TypeProcedure::class, 'id_type_procedure', 'id');
    }
    public function succursale(): BelongsTo
    {
        return $this->belongsTo(Succursale::class, 'id_succursale', 'id');
    }
}
