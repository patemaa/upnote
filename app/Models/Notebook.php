<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notebook extends Model
{
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
