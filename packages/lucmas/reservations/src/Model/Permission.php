<?php

namespace Lucmas\Reservations\Model;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Permission
 * @package App
 *
 * @property string slug
 * @property string name
 * @property string description
 * @property integer id
 * @property integer group_id
 *
 * @property \Illuminate\Database\Eloquent\Collection roles collezione di oggetti di tipo Role
 * @property \Illuminate\Database\Eloquent\Collection users collezione di oggetti di tipo User
 * @property PermissionGroup group collezione di oggetti di tipo PermissionGroup
 *
 * @method static Permission find(mixed $id)
 * @method static \Illuminate\Database\Eloquent\Builder where(string|array $column, string  $relation = null, mixed $value = null)
 * @method static \Illuminate\Database\Eloquent\Builder withTranslation()
 * @method static Permission create(array $values)
 */
class Permission extends Model {
    use Translatable;

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function roles() {
        return $this->belongsToMany(app()->make(Role::class), 'roles_permissions');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function users() {
        return $this->belongsToMany(app()->make(User::class), 'users_permissions');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function group() {
        return $this->belongsTo(app()->make(PermissionGroup::class), 'group_id', 'id');
    }

    public function getTrimmedDescriptionAttribute() {
        if (strlen($this->description) > 100)
            return substr($this->description, 0, 100) . '...';
        else
            return $this->description;
    }

    /**
     * @inheritDoc
     */
    public function resolveChildRouteBinding($childType, $value, $field)
    {
        // TODO: Implement resolveChildRouteBinding() method.
    }
}
