<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'slug', 'description', 'start_at', 'status', 'category_id',
    ];

    protected $casts = [
        'start_at' => 'date:Y-m-d',
    ];

    /* Relationships */

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'project_tag', 'project_id', 'tag_id');
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
