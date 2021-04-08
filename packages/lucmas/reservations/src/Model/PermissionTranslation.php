<?php

namespace Lucmas\Reservations\Model;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class PermissionTranslation extends Model {
    use AuditableTrait;

    protected $fillable = ['name', 'description'];
}
