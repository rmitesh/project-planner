<?php

namespace App\Models;

use App\Models\Technology;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'created_by', 'level',
    ];

    protected static function getLevels(): array
    {
        return [
            'Basic',
            'Intermediate',
            'Semi-Advanced',
            'Advanced',
        ];
    }

    /* Relationships */

    public function technologies(): BelongsToMany
    {
        return $this->belongsToMany(Technology::class, 'assignment_technology', 'assignment_id', 'technology_id');
    }
}
