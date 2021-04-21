<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $title
 * @property int $is_visible
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\CategoryFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereIsVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @method static list(bool $isAdmin = false)
 * @mixin \Eloquent
 */
class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'title', 'is_visible'
    ];

    protected $casts = [
            'is_visible' => 'boolean'
        ];


    public function news(): HasMany
    {
        return $this->hasMany(News::class, 'category_id', 'id');
    }


    public function scopeList($query, $isAdmin = false): Builder
    {
        if ($isAdmin) {
            return $query->select(['id', 'title', 'is_visible', 'created_at', 'updated_at']);
        }
        return $query->select(['id', 'title'])
            ->whereHas('news', fn ($query) => $query->select(['status'])->where('status', '=', 'published'))
            ->where('is_visible', '=', true);
    }


}
