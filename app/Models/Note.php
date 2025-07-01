<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = ['title', 'content', 'category', 'pinned', 'user_id'];
    protected $casts = ['is_favorite' => 'boolean',];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function notebook()
    {
        return $this->belongsTo(Notebook::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function versions()
    {
        return $this->hasMany(NoteVersion::class);
    }
}
