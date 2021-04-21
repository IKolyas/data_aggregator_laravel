<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\News
 *
 * @property int $id
 * @property int $category_id
 * @property string $title
 * @property string|null $slug
 * @property string|null $image
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\NewsFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|News newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|News newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|News query()
 * @method static \Illuminate\Database\Eloquent\Builder|News whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereUpdatedAt($value)
 * @method static list(bool $isAdmin = false)
 * @mixin Eloquent
 */
class News extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $table = 'news';

    protected $fillable = [
         'title', 'slug',  'image', 'description', 'status'
    ];

    //добавил "мягкое удаление" (при удалении в поле deleted_at добавляется дата удаления но сам объект не ужаляется из базы,
    //объекты с полем deleted_at отличным от null игнорируются при выборках)
    /**
     * @var string[]
     */
    protected $dates = ['deleted_at'];


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)->withDefault();
    }


    public function scopeList($query, $isAdmin = false): Builder
    {
        if ($isAdmin) {
            return $query
                ->with('category')
                ->select(['id', 'category_id', 'title', 'description', 'slug', 'image', 'status', 'created_at', 'updated_at']);
        }
        return $query
            ->with('category')
            ->select(['id', 'title', 'category_id', 'description', 'slug', 'image', 'status', 'created_at'])
            ->where('status', '=', 'published')
            ->whereHas('category', fn ($query) => $query->select(['id', 'title'])->where('is_visible', '=', true));
    }
}
