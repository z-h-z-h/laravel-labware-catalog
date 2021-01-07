<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property int|null $parent_id
 * @property int $company_id
 * @property string $slug
 * @property string $title
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|HasFactory
 * @property-read Company $company
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @mixin Eloquent
 * @property Carbon|null $updated_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Category[] $nestedCategories
 * @property-read int|null $nested_categories_count
 * @property-read Category|null $parentCategory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Set[] $sets
 * @property-read int|null $sets_count
 */
class Category extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'slug',
        'title',
        'description',
        'parent_id',
        'company_id'
    ];

    public function scopeSearch($query, string $search)
    {
        return $query->where('title', 'LIKE', '%' . $search . '%');
    }

    public function scopeParents($query)
    {
        return $query->wherenull('parent_id')->orderBy('company_id');
    }

    public function scopeNested($query)
    {
        return $query->whereNotnull('parent_id')->orderBy('company_id');
    }

    public function scopeForCompany($query, int $companyId)
    {
        return $query->where('company_id', $companyId);
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('photo')
            ->useFallbackUrl('/img/no_photo.png')
            ->registerMediaConversions(function () {
                $this
                    ->addMediaConversion('thumb')
                    ->width(100)
                    ->height(100);
            });
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function nestedCategories(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parentCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function sets(): HasMany
    {
        return $this->hasMany(Set::class);
    }
}
