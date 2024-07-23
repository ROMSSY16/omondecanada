<?php

namespace App\Models;

use App\Models\User;
use App\Models\Candidat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RendezVous extends Model
{
    use HasFactory;

    protected $table = 'rdv';
    protected $guarded = [];

    public function candidat(): BelongsTo
    {
        return $this->belongsTo(Candidat::class, 'candidat_id', 'id');
    }

    public function commercial(): BelongsTo
    {
        return $this->belongsTo(User::class, 'commercial_id', 'id');
    }
}
