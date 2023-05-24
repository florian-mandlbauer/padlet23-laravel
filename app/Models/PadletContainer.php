<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PadletContainer extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'isPublic'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function padlets(): HasMany
    {
        return $this->hasMany(Padlet::class);
    }

    public function padletContainerUsers(): HasMany {
        return $this->hasMany(PadletContainerUser::class);
    }
}
