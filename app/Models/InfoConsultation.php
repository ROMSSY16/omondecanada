<?php

namespace App\Models;

use \App\Models\Candidat;
use App\Models\Consultante;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InfoConsultation extends Model
{
    use HasFactory;

    public $timestamps= false;
    protected $table ='info_consultation';

    protected $guarded = [];

        public function consultante(): BelongsTo
        {
            return $this->belongsTo(Consultante::class, 'id_consultante', 'id');
        }

        public function candidats(): HasMany
        {
            return $this->hasMany(Candidat::class);
        }
}
