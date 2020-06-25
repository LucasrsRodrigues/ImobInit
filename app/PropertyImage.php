<?php

namespace Imobinit;

use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
    protected $fillable = [
        'property',
        'path',
        'cover'
    ];
}
