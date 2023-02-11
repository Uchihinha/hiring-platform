<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wallet extends Model
{
    use HasFactory;

    public function WalletStatements(): HasMany
    {
        return $this->hasMany(WalletStatement::class);
    }
}
