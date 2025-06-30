<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoteVersion extends Model
{
    public $timestamps = false;

    protected $fillable = ['note_id', 'content', 'saved_at'];

    protected $casts = [
        'saved_at' => 'datetime',
    ];

    public function note()
    {
        return $this->belongsTo(Note::class);
    }
}
