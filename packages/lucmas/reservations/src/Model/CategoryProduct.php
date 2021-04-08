<?php

namespace Lucmas\Reservations\Model;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

/**
 * Class CategoryProduct
 * @package App
 *
 * @property int category_id
 * @property int product_id
 * @property int position
 *
 * @method static CategoryProduct find(mixed $id)
 * @method static \Illuminate\Database\Eloquent\Builder where(string|array $column, string $relation = null, mixed $value = null)
 * @method static \Illuminate\Database\Eloquent\Builder withTranslation()
 * @method static int max(string $column)
 */
class CategoryProduct extends Model
{
    use AuditableTrait;

    protected $primaryKey = null;

    protected $fillable = ['position'];

    public $searchable = ['code', 'position'];
    public $searchableTranslation = ['name', 'description'];

    public $sortable = ['code', 'position'];
    public $sortableTranslation = ['name', 'description'];

    public $hasPosition = true;

    public $pivotProperty = ['position'];
}
