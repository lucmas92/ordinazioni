<?php

namespace Lucmas\Reservations\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Yajra\Auditable\AuditableTrait;

/**
 * Class Permission
 * @package App
 *
 * @property string slug
 * @property string name
 * @property string description
 * @property integer id
 *
 * @property \Illuminate\Database\Eloquent\Collection permissions collezione di oggetti di tipo Permission
 *
 * @method static PermissionGroup find(mixed $id)
 * @method static Builder where(string|array $column, string  $relation = null, mixed $value = null)
 * @method static Builder withTranslation()
 */
class PermissionGroup extends Model {
    use Translatable, AuditableTrait;

    public $table = 'permission_group';

    public $translatedAttributes = ['name', 'description'];

    protected $fillable = ['slug'];

    public $searchable = ['slug'];
    public $searchableTranslation = ['name', 'description'];

    public $sortable = ['slug'];
    public $sortableTranslation = ['name', 'description'];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName() {
        return 'slug';
    }

    /**
     * Get the value of the model's route key.
     *
     * @return mixed
     */
    public function getRouteKey() {
        return $this->slug;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function permissions() {
        return $this->hasMany(app()->make(Permission::class), 'group_id');
    }

    public function getTrimmedDescriptionAttribute() {
        if (strlen($this->description) > 100)
            return substr($this->description, 0, 100) . '...';
        else
            return $this->description;
    }
}
