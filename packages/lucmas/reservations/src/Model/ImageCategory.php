<?php

namespace Lucmas\Reservations\Model;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Yajra\Auditable\AuditableWithDeletesTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ImageCategory
 * @package App
 *
 * @property boolean cover
 * @property integer position
 * @property string name
 * @property integer category_id
 * @property integer collection_id
 * @property integer file_id
 *
 * @property Category category
 * @property Collection collection
 * @property File file
 *
 * @method static ImageCategory find(mixed $id)
 * @method static \Illuminate\Database\Eloquent\Builder where(string|array $column, string $relation = null, mixed $value = null)
 * @method static \Illuminate\Database\Eloquent\Builder withTranslation()
 * @method static int max(string $column)
 * @method ImageCategory first()
 */
class ImageCategory extends Model
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
            'table1' => 'image_categories',
            'table2' => 'files',
            'column1' => 'file_id',
            'column2' => 'id',
            'relationship' => 'file',
            'property' => 'extension',
            'name' => 'file-extension'
        ],
        'file-size' => [
            'table1' => 'image_categories',
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

        static::creating(function (ImageCategory $model) {
            if ($model->position == NULL)
                $model->position = app()->make(ImageCategory::class)::where('category_id', '=', $model->category_id)->max('position') + 1;
            if ($model->cover == NULL) {
                if (app()->make(ImageCategory::class)::where('category_id', '=', $model->category_id)->count() == 0)
                    $model->cover = 1;
                else
                    $model->cover = 0;
            }
        });
        static::deleting(function (ImageCategory $model) {
            app()->make(ImageCategory::class)::where([['category_id', '=', $model->category_id], ['position', '>', $model->position]])->decrement('position');
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function category()
    {
        return $this->belongsTo(app()->make(Category::class));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function collection()
    {
        return $this->belongsTo(app()->make(Collection::class));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function file()
    {
        return $this->belongsTo(app()->make(File::class));
    }
}
