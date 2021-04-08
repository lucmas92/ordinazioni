<?php

namespace Lucmas\Reservations\Model;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class ImageCategoryTranslation extends Model
{
    use AuditableTrait;

    protected $fillable = ['name'];
}
