<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notebook extends Model
{
    protected $fillable = ['name', 'user_id'];

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
