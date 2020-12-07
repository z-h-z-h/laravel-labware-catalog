<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Models\Set
 *
 * @property int $id
 * @property int $category_id
 * @property int $company_id
 * @property string $slug
 * @property string $title
 * @property string $code
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @property-read \App\Models\Company $company
 * @method static \Illuminate\Database\Eloquent\Builder|Set newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Set newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Set query()
 * @method static \Illuminate\Database\Eloquent\Builder|Set whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Set whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Set whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Set whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Set whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Set whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Set whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Set whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Set whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Set extends Model implements HasMedia
{
    use HasFactory;


    use InteractsWithMedia;


    protected $fillable = [
        'slug',
        'title',
        'description',
        'code',
        'category_id',
        'company_id',
    ];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('sets')
            ->registerMediaConversions(function () {
                $this
                    ->addMediaConversion('thumb')
                    ->width(100)
                    ->height(100);
            });
    }

    public function company(): HasOneThrough
    {
        return $this->hasOneThrough(Company::class, Category::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
