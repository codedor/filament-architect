<?php

namespace Codedor\FilamentArchitect\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchitectTemplate extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'body'];

    protected $casts = [
        'body' => 'array',
    ];
}
