<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Archiver extends Model
{
    public function archiverCategory()
    {
        return $this->belongsTo(ArchiverCategory::class);
    }
}
