<?php

namespace Lucmas\Reservations\Model;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class CategoryTranslation extends Model
{
    use AuditableTrait;

    protected $fillable = ['name', 'description_short', 'description'];
}
