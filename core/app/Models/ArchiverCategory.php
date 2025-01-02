<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArchiverCategory extends Model
{

    public function archivers()
    {
        return $this->hasMany(Archiver::class);
    }
}
