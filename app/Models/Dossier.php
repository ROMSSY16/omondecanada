<?php

namespace App\Models;

use App\Models\User;
use App\Models\Candidat;
use App\Models\Document;
use App\Models\TypeProcedure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dossier extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function candidat(): BelongsTo
    {
        return $this->belongsTo(Candidat::class, 'id_candidat', 'id');
    }
    public function agent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_agent', 'id');
    }
    public function typeProcedure(): BelongsTo
    {
        return $this->belongsTo(TypeProcedure::class, 'id_type_procedure', 'id');
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }
}

