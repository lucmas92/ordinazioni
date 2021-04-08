<?php

namespace Lucmas\Reservations\Model;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class ImageProductTranslation extends Model {
    use AuditableTrait;

    protected $fillable = ['name'];
}
