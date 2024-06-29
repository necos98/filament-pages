<?php

namespace Pages\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PageMeta extends Model
{
    protected $fillable = ['page_id', 'key', 'value'];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}