<?php

namespace Pages\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelTranslation extends Model
{
    use HasFactory;

    public function modelable()
    {
        return $this->morphTo();
    }
}
