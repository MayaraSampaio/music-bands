<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = [
        'band_id',
        'name',
        'image',
        'released_at'];

// A banda a que o álbum pertence.Uma banda pode ter varios albuns.
    public function band()
    {
        return $this->belongsTo(Band::class);
    }
}
