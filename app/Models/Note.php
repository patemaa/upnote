<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = ['title', 'content'];
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function notebook()
    {
        return $this->belongsTo(Notebook::class);
    }

}
