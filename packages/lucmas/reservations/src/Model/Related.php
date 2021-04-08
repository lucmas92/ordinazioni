<?php

namespace Lucmas\Reservations\Model;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

/**
 * Class Related
 * @package App
 *
 * @property integer product_id
 * @property integer related_id
 * @property integer collection_id
 * @property integer position
 *
 * @property \Illuminate\Database\Eloquent\Collection products
 * @property Collection collection
 *
 * @method static Related find(mixed $id)
 * @method static \Illuminate\Database\Eloquent\Builder where(string|array $column, string $relation = null, mixed $value = null)
 * @method static int max(string $column)
 */
class Related extends Model
{
    use AuditableTrait;

    protected $fillable = ['collection_id', 'position'];

    public $searchable = ['code', 'name', 'collection'];
    //public $searchableTranslation = ['name', 'collection'];

    public $sortable = ['code', 'name', 'collection'];
    //public $sortableTranslation = ['name', 'collection'];

    public $hasPosition = true;

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Related $model) {
            if ($model->position == NULL)
                $model->position = app()->make(Related::class)::where('product_id', '=', $model->product_id)->max('position') + 1;
        });
        static::deleting(function (Related $model) {
            if (app()->make(Related::class)::where([['product_id', '=', $model->product_id], ['related_id', '=', $model->related_id]])->exists())
                app()->make(Related::class)::where([
                        ['product_id', '=', $model->product_id],
                        ['related_id', '=', $model->related_id],
                        ['position', '>', $model->position]]
                )->decrement('position');
            else
                app()->make(Related::class)::where([
                        ['product_id', '=', $model->related_id],
                        ['related_id', '=', $model->product_id],
                        ['position', '>', $model->position]]
                )->decrement('position');
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function product()
    {
        return $this->belongsTo(app()->make(Product::class), 'related_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function product2()
    {
        return $this->belongsTo(app()->make(Product::class), 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function collection()
    {
        return $this->belongsTo(app()->make(Collection::class));
    }
}
