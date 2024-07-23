<?php

namespace App\Models;

use App\Models\Candidat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FicheConsultation extends Model
{
    use HasFactory;

    protected $table ='fiche_consultation';
    
    protected $guarded = [];

    public function candidat(): BelongsTo
{
    return $this->belongsTo(Candidat::class, 'id_candidat');
}

}
