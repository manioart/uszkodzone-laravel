<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'creator_id',
        'fileable_type',
        'fileable_id',
        'original_name',
        'path'
    ];

    /**
     * @return MorphTo
     *
     */
    public function fileable(): MorphTo
    {
        return $this->morphTo();
    }
}
