<?php

namespace Lucmas\Reservations\Model;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Yajra\Auditable\AuditableWithDeletesTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Role
 * @package App
 *
 * @property int id
 * @property string slug
 * @property string name
 * @property string description
 * @property integer parent_id
 *
 * @property \Illuminate\Database\Eloquent\Collection permissions collezione di oggetti di tipo \App\Permission
 * @property \Illuminate\Database\Eloquent\Collection children
 * @property Role parent
 * @property \Illuminate\Database\Eloquent\Collection users
 *
 * @method static Role find(mixed $id)
 * @method static Builder where(string|array $column, string $relation = null, mixed $value = null)
 * @method static Builder withTranslation()
 */
class Role extends Model
{
    use SoftDeletes, Translatable, AuditableWithDeletesTrait;

    const SUPERADMIN = 'superadmin';

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
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the value of the model's route key.
     *
     * @return mixed
     */
    public function getRouteKey()
    {
        return $this->slug;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @throws BindingResolutionException
     */
    public function permissions()
    {
        return $this->belongsToMany(app()->make(Permission::class), 'roles_permissions');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @throws BindingResolutionException
     */
    public function children()
    {
        return $this->hasMany(app()->make(Role::class), 'parent_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * @throws BindingResolutionException
     */
    public function parent()
    {
        return $this->hasOne(app()->make(Role::class), 'id', 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @throws BindingResolutionException
     */
    public function users()
    {
        return $this->hasMany(app()->make(User::class));
    }

    public function allChildren()
    {

        $list = [];

        $list[$this->id] = $this;

        $children = $this->children;

        foreach ($children as $child) {

            $list[$child->id] = $child;

            foreach ($child->allChildren() as $subChild) {
                $list[$subChild->id] = $subChild;
            }
        }

        return $list;
    }

    public function allParents()
    {
        $list = [];
        array_push($list, $this);//$list[$this->id] = $this;

        $parent = $this->parent;
        while ($parent != NULL) {
            array_push($list, $parent);
            $parent = $parent->parent;
        }
        return $list;
    }

    public function parents()
    {
        $list = [];
        //array_push($list, $this->id);
        $parent = $this->parent;
        while ($parent != NULL) {
            array_push($list, $parent->id);
            $parent = $parent->parent;
        }
        return $list;
    }

    public function hasP(Permission $permission)
    {
        if ($this->permissions->contains($permission))
            return true;
        if ($this->parent)
            return $this->parent->hasP($permission);
        else
            return false;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws BindingResolutionException
     */
    public function allPermissions()
    {
        if ($this->parent_id == NULL)
            return $this->permissions()->get();
        else
            return $this->permissions()->get()->merge($this->parent->allPermissions());
    }

    public function getTrimmedDescriptionAttribute() {
        if (strlen($this->description) > 100)
            return substr($this->description, 0, 100) . '...';
        else
            return $this->description;
    }
}
