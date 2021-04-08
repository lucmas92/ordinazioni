<?php

namespace Lucmas\Reservations\Model;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class PermissionGroupTranslation extends Model {
    use AuditableTrait;

    protected $fillable = ['name', 'description'];
}
