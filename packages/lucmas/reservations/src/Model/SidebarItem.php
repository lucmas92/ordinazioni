<?php

namespace Lucmas\Reservations\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SidebarItem
 * @package App
 *
 * @property int id
 * @property string name
 * @property int parent_id
 * @property string route
 * @property string permission
 * @property int position
 * @property string icon
 *
 * @property SidebarItem parent
 * @property \Illuminate\Database\Eloquent\Collection children
 *
 * @method static SidebarItem create(array $values)
 * @method static SidebarItem find(mixed $id)
 * @method static \Illuminate\Database\Eloquent\Builder where(string|array $column, string $relation = null, mixed $value = null)
 */
class SidebarItem extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function (SidebarItem $model) {
            if ($model->position == NULL)
                $model->position = app()->make(SidebarItem::class)::where('parent_id', '=', $model->parent_id)->max('position') + 1;
        });
        static::deleting(function (SidebarItem $model) {
            app()->make(SidebarItem::class)::where([
                    ['parent_id', '=', $model->parent_id],
                    ['position', '>', $model->position]]
            )->decrement('position');
        });
    }

    protected $table = 'sidebar_item';
    public $timestamps = false;

    public $guarded = [];

    /**
     * Metodo che restituisce le categorie figlie
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function children()
    {
        return $this->hasMany(app()->make(SidebarItem::class), 'parent_id', 'id');
    }

    /**
     * Metodo che restituisce la categoria genitore
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function parent()
    {
        return $this->hasOne(app()->make(SidebarItem::class), 'id', 'parent_id');
    }

    public function routeBase()
    {
        if ($this->route == NULL)
            return '';
        $index = strpos($this->route, '.');
        return substr($this->route, 0, $index) . '\.';
    }

    public function allRouteBase()
    {
        if ($this->children->isEmpty()) {
            if ($this->route != NULL)
                return $this->routeBase();
            else
                return '';
        }
        if ($this->routeBase() != '')
            $string = "{$this->routeBase()}|";
        else
            $string = '';
        foreach ($this->children as $child)
            $string .= "{$child->allRouteBase()}|";
        return substr($string, 0, -1);
    }

    public function level()
    {
        if ($this->parent_id == NULL)
            return 0;
        else
            return 1 + ($this->parent)->level();
    }

    public function allPermissions()
    {
        if ($this->children->isEmpty())
            if ($this->permission != NULL)
                return [$this->permission];
            else
                return [];

        if ($this->permission != NULL)
            $permissions = [$this->permission];
        else
            $permissions = [];
        foreach ($this->children as $child)
            $permissions = array_merge($permissions, $child->allPermissions());
        return $permissions;
    }
}
