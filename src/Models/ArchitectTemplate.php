<?php

namespace Wotz\FilamentArchitect\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property array $body
 */
class ArchitectTemplate extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'body'];

    protected $casts = [
        'body' => 'array',
    ];
}
