<?php

namespace App\Models;

use App\Models\Tags;
use App\Models\Candidat;
use App\Models\Versement;
use App\Models\TypeProcedure;
use App\Models\StatutProcedure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Procedure extends Model
{
    use HasFactory;
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

    public function versements(): HasMany
    {
        return $this->hasMany(Versement::class);
    }
}
