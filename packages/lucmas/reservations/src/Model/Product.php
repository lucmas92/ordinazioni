<?php

namespace Lucmas\Reservations\Model;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Yajra\Auditable\AuditableWithDeletesTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Permission
 * @package App
 *
 * @property integer id
 * @property string code
 * @property boolean active
 * @property string name
 * @property string description_short
 * @property string description
 * @property float price
 *
 * @property \Illuminate\Database\Eloquent\Collection related collezione di oggetti di tipo Related
 * @property \Illuminate\Database\Eloquent\Collection relatedTo collezione di oggetti di tipo AppRelated
 * @property \Illuminate\Database\Eloquent\Collection attachments collezione di oggetti di tipo AppAttachmentProduct
 * @property \Illuminate\Database\Eloquent\Collection videos collezione di oggetti di tipo AppAttachmentProduct
 * @property \Illuminate\Database\Eloquent\Collection features collezione di oggetti di tipo AppFeature
 * @property \Illuminate\Database\Eloquent\Collection categories collezione di oggetti di tipo AppCategory
 * @property \Illuminate\Database\Eloquent\Collection images collezione di oggetti di tipo ImageProduct
 *
 * @method static Product find(mixed $id)
 * @method static Builder whereNotIn(string $column, mixed $values)
 * @method static Builder where(mixed $column, string $relation = null, mixed $value = null)
 * @method static Builder withTranslation()
 */
class Product extends Model
{
    use SoftDeletes, Translatable, AuditableWithDeletesTrait;

    public $translatedAttributes = ['name', 'description', 'description_short'];

    protected $fillable = ['code', 'active', 'price'];

    protected static function boot()
    {
        parent::boot();

        parent::creating(function (Product $model) {
            if ($model->active == NULL)
                $model->active = true;
        });

        static::addGlobalScope('active', function (Builder $builder) {
            $user = Auth::user();
            if ($user != NULL && !$user->can('view-inactive-product'))
                $builder->where('active', '=', 1);
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function images()
    {
        return $this->hasMany(app()->make(ImageProduct::class));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function related()
    {
        return $this->hasMany(app()->make(Related::class));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function relatedTo()
    {
        return $this->hasMany(app()->make(Related::class), 'related_id');
    }

    public function allRelated()
    {
        $relatedTo = $this->relatedTo;
        foreach ($relatedTo as &$r) {
            $tmp = clone $r->product;
            $r->product = clone $r->product2;
            $r->product2 = $tmp;
        }

        return collect($this->related)->merge($relatedTo);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function categories()
    {
        return $this->belongsToMany(app()->make(Category::class), 'category_products')
            ->withPivot('position', 'created_by', 'updated_by')->withTimestamps();
    }


}
