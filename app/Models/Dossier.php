<?php

namespace App\Models;

use App\Models\User;
use App\Models\Candidat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }
}

