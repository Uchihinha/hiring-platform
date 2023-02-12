<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'id'
    ];

    public function wallets(): HasMany
    {
        return $this->hasMany(Wallet::class);
    }

    public function wallet(): ?Wallet
    {
        return $this->wallets->first();
    }
}
