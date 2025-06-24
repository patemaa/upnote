<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function notebook()
    {
        return $this->belongsTo(Notebook::class);
    }

}
