<?php

namespace App\Models;

use App\Models\Procedure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tags extends Model
{
    // Table name (optional if it follows Laravel's naming conventions)
    protected $table = 'tags';

    protected $guarded = [];

    public function procedure(): BelongsToMany
    {
        return $this->belongsToMany(Procedure::class , 'id');
    }
}
