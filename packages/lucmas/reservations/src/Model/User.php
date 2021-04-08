<?php

namespace Lucmas\Reservations\Model;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection as CollectionAlias;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Lucmas\Reservations\Traits\CanAnyTrait;

/**
 * Class User
 * @package App
 *
 * @property string name
 * @property string username
 * @property string email
 * @property string password
 * @property integer id
 * @property integer role_id
 *
 * @property Role role
 * @property CollectionAlias permissions
 *
 * @method static User find(mixed $id)
 * @method static Builder where(string|array $column, string $relation = null, mixed $value = null)
 * @method boolean can(string|array $permission)
 * @method MorphMany notifications()
 * @method MorphMany unreadNotifications()
 */
class User extends Authenticatable
{
    use SoftDeletes, Notifiable, CanAnyTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public $searchable = ['name', 'username', 'email'];
    public $searchableRelationship = [
        'role-name' => [
            'relationship' => 'role',
            'property' => 'role_translations.name',
            'name' => 'role-name',
            'is-translation' => true
        ]
    ];

    public $sortable = ['name', 'username', 'email'];
    public $sortableRelationship = [
        'role-name' => [
            'table1' => 'users',
            'table2' => 'roles',
            'column1' => 'role_id',
            'column2' => 'id',
            'table3' => 'role_translations',
            'column3' => 'role_id',
            'relationship' => 'role',
            'property' => 'name',
            'name' => 'role-name'
        ]
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @throws BindingResolutionException
     */
    public function role()
    {
        return $this->belongsTo(app()->make(Role::class));
    }

    /**
     * @return BelongsToMany
     * @throws BindingResolutionException
     */
    public function permissions()
    {
        return $this->belongsToMany(app()->make(Permission::class), 'users_permissions');
    }

    /**
     * Metodo che verifica se l'utente ha il permesso (o è superadmin)
     * @param Permission $permission
     * @return bool
     * @throws BindingResolutionException
     */
    public function hasPermissionTo(Permission $permission)
    {
        if ($this->isSuperAdmin())
            return true;

        return $this->permissions()->where('id', '=', $permission->id)->exists()
            || $this->role->hasP($permission);
    }

    public function isSuperAdmin()
    {
        return $this->role->slug == 'superadmin';
    }

}
