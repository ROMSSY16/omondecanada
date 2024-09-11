<?php

namespace App\Models;

use App\Models\Procedure;
use App\Models\ModePaiement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Versement extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function procedure(): BelongsTo
    {
        return $this->belongsTo(Procedure::class, 'id_procedure');
    }
    public function modePaiement(): BelongsTo
    {
        return $this->belongsTo(ModePaiement::class, 'id_moyen_paiement');
    }
}
