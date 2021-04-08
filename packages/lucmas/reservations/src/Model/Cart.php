<?php

namespace Lucmas\Reservations\Model;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Log;
use Yajra\Auditable\AuditableWithDeletesTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes, AuditableWithDeletesTrait;

    protected $fillable = [
        'table_id'
    ];

    public function products()
    {
        return $this->belongsToMany(app('Product'))->withPivot('quantity');
    }

    public function table()
    {
        return $this->belongsTo(app('Table'));
    }

}
