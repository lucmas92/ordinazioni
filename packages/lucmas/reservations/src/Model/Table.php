<?php

namespace Lucmas\Reservations\Model;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableWithDeletesTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Table extends Model
{
    use SoftDeletes, AuditableWithDeletesTrait;

    protected $fillable = ['number'];

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function order()
    {
        return $this->hasOne(Order::class);
    }

}
