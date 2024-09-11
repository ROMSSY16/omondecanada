<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Entree;
use App\Models\Dossier;
use App\Models\Procedure;
use App\Models\RendezVous;
use App\Models\TypeProcedure;
use App\Models\InfoConsultation;
use App\Models\FicheConsultation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Candidat extends Model
{
    use HasFactory;
    
    protected $table = 'candidat';
    protected $guarded = [];
    
    public static function sauvegarderCandidat($data)
    {
        return self::create($data);
    }
    public function entrees(): HasMany
    {
        return $this->hasMany(Entree::class);
    }
    
    public function utilisateur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_utilisateur', 'id');
    }
    public function consultante(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_consultante', 'id');
    }

    public function ficheConsultation(): HasOne
    {
        return $this->hasOne(FicheConsultation::class, 'id_candidat', 'id');
    }
    public function infoConsultation(): BelongsTo
    {
        return $this->belongsTo(InfoConsultation::class, 'id_info_consultation', 'id');
    }

     public function proceduresDemandees(): HasOne
    {
        return $this->hasOne(Procedure::class, 'id_candidat', 'id');
    }

    public function rendezVous(): HasOne
    {
        return $this->hasOne(RendezVous::class, 'candidat_id', 'id');
    }
    public function dossier(): HasOne
    {
        return $this->hasOne(Dossier::class, 'id_candidat', 'id');
    }
    public function typeProcedure(): BelongsTo
    {
        return $this->belongsTo(TypeProcedure::class, 'id_type_procedure', 'id');
    }
}

