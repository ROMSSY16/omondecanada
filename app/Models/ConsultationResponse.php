<?php

// app/Models/ConsultationResponse.php

namespace App\Models;

use App\Models\Question;
use App\Models\ConsultationRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ConsultationResponse extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function consultationRecord(): BelongsTo
    {
        return $this->belongsTo(ConsultationRecord::class, 'consultation_record_id', 'id');
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }
}
