<?php

namespace App\Models;

use App\Models\User;
use App\Models\Candidat;

use App\Models\Procedure;
use App\Models\InfoConsultation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Consultante extends Model
{
    use HasFactory;

    protected $table = 'consultante';
    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_utilisateur', 'id');
    }

    public function infoConsultations(): HasMany
    {
        return $this->hasMany(InfoConsultation::class);
    }

// Modèle InfoConsultation
    public function candidats(): HasMany
    {
        return $this->hasMany(Candidat::class);
    }

    public function procedures(): HasMany
    {
        return $this->hasMany(Procedure::class);
    }
}
