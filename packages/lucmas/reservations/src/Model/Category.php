<?php

namespace Lucmas\Reservations\Model;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Yajra\Auditable\AuditableWithDeletesTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Category
 * @package App
 *
 * @property integer id
 * @property string code
 * @property boolean active
 * @property integer parent_id
 * @property integer position
 * @property string name
 * @property string description
 *
 * @property \Illuminate\Database\Eloquent\Collection children
 * @property Category parent
 * @property \Illuminate\Database\Eloquent\Collection features collezione di oggetti di tipo Feature
 * @property \Illuminate\Database\Eloquent\Collection products
 * @property \Illuminate\Database\Eloquent\Collection images
 * @property \Illuminate\Database\Eloquent\Collection attachments
 * @property \Illuminate\Database\Eloquent\Collection videos
 *
 * @method static Category find(mixed $id)
 * @method static \Illuminate\Database\Eloquent\Builder where(string|array $column, string $relation = null, mixed $value = null)
 * @method static \Illuminate\Database\Eloquent\Builder withTranslation()
 * @method static int max(string $column)
 */
class Category extends Model
{
    use SoftDeletes, Translatable, AuditableWithDeletesTrait;

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Category $model) {
            if ($model->active == NULL)
                $model->active = true;

            if(is_null($model->code))
                $model->code = 'TEMP' . time();

            if ($model->position == NULL)
                $model->position = app()->make(Category::class)::where('parent_id', '=', $model->parent_id)->max('position') + 1;
        });
        static::created(function (Category $model) {
            if(is_null($model->code) || preg_match('(TEMP)', $model->code)) {
                $model->code = 'CAT' . $model->id;
                $model->save();
            }
        });
        static::deleting(function (Category $model) {
            app()->make(Category::class)::where([['parent_id', '=', $model->parent_id], ['position', '>', $model->position]])->decrement('position');
        });
    }

    public $translatedAttributes = ['name', 'description_short', 'description'];

    protected $fillable = ['position','active'];

    public $hasPosition = true;


    public $pivotProperty = ['position'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @throws BindingResolutionException
     */
    public function children()
    {
        return $this->hasMany(app()->make('Category'), 'parent_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * @throws BindingResolutionException
     */
    public function parent()
    {
        return $this->hasOne(app()->make('Category'), 'id', 'parent_id');
    }

    /**
     * @return BelongsToMany
     * @throws BindingResolutionException
     */
    public function products()
    {
        return $this->belongsToMany(app()->make('Product'), 'category_products')
            ->withPivot('position', 'created_by', 'updated_by')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @throws BindingResolutionException
     */
    public function images()
    {
        return $this->hasMany(app()->make('ImageCategory'));
    }

    public function getCoverAttribute() {
        $cover = $this->images->where('cover', '=', '1')->first();
        if ($cover)
            return $cover->file->id;
        else
            return 'placeholder.png';
    }

}
