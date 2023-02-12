<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    public const INITIAL = 'none';
    public const CONTACTED = 'contacted';
    public const HIRED = 'hired';

    protected $fillable = [
        'vacancy_id'
    ];
}
