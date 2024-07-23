<?php

// app/Models/ConsultationRecord.php

namespace App\Models;

use App\Models\User;
use App\Models\ConsultationResponse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ConsultationRecord extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function responses(): HasMany
    {
        return $this->hasMany(ConsultationResponse::class);
    }
}
