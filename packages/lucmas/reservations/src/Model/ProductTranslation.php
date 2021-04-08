<?php

namespace Lucmas\Reservations\Model;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class ProductTranslation extends Model
{
    use AuditableTrait;

    protected $fillable = ['name', 'description', 'description_short'];

}
