<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Procedure extends Model
{
    use HasFactory;

    protected $table = 'procedure_demande';
    protected $guarded = [];

    public function candidat(): BelongsTo
    {
        return $this->belongsTo(Candidat::class, 'id_candidat');
    }

    public function typeProcedure(): BelongsTo
    {
        return $this->belongsTo(TypeProcedure::class, 'id_type_procedure');
    }

    public function consultante(): HasOne
    {
        return $this->hasOne(consultante::class, 'id' ,  'consultante_id' );
    }

    public function statut(): BelongsTo
    {
        return $this->belongsTo(StatutProcedure::class);
    }
    public function tag(): HasOne
    {
        return $this->hasOne(Tags::class, 'id', 'tag_id');
    }
}
