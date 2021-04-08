<?php

namespace Lucmas\Reservations\Model;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Yajra\Auditable\AuditableWithDeletesTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ImageProduct
 * @package App
 *
 * @property int id
 * @property boolean cover
 * @property integer position
 * @property string name
 * @property integer product_id
 * @property integer file_id
 * @property integer collection_id
 *
 * @property Product product prodotto al quale l'immagine appartiene
 * @property File file informazioni dell'immagine
 * @property Collection collection collezione alla quale appartiene l'immagine
 *
 * @method static ImageProduct find(mixed $id)
 * @method static \Illuminate\Database\Eloquent\Builder where(string|array $column, string $relation = null, mixed $value = null)
 * @method static \Illuminate\Database\Eloquent\Builder withTranslation()
 * @method static int max(string $column)
 */
class ImageProduct extends Model
{
    use SoftDeletes, Translatable, AuditableWithDeletesTrait;

    public $translatedAttributes = ['name'];

    protected $fillable = ['cover', 'position'];

    public $hasPosition = true;

    public $searchable = ['position', 'cover'];
    public $searchableTranslation = ['name'];
    public $searchableRelationship = [
        'file-extension' => [
            'relationship' => 'file',
            'property' => 'extension',
            'name' => 'file-extension'
        ],
        'file-dimension' => [
            'relationship' => 'file',
            'property' => 'size',
            'name' => 'file-size'
        ]
    ];

    public $sortable = ['position', 'cover'];
    public $sortableTranslation = ['name'];
    public $sortableRelationship = [
        'file-extension' => [
            'table1' => 'image_products',
            'table2' => 'files',
            'column1' => 'file_id',
            'column2' => 'id',
            'relationship' => 'file',
            'property' => 'extension',
            'name' => 'file-extension'
        ],
        'file-size' => [
            'table1' => 'image_products',
            'table2' => 'files',
            'column1' => 'file_id',
            'column2' => 'id',
            'relationship' => 'file',
            'property' => 'size',
            'name' => 'file-size'
        ]
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (ImageProduct $model) {
            if ($model->position == NULL)
                $model->position = app()->make(ImageProduct::class)::where('product_id', '=', $model->product_id)->max('position') + 1;
            if ($model->cover == NULL) {
                if (app()->make(ImageProduct::class)::where('product_id', '=', $model->product_id)->count() == 0)
                    $model->cover = 1;
                else
                    $model->cover = 0;
            }
        });
        static::deleting(function (ImageProduct $model) {
            app()->make(ImageProduct::class)::where([['product_id', '=', $model->product_id], ['position', '>', $model->position]])->decrement('position');
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function product()
    {
        return $this->belongsTo(app()->make(Product::class));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function file()
    {
        return $this->belongsTo(app()->make(File::class));
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
