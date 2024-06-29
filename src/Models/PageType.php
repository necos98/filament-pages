<?php

namespace Pages\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PageType extends Model
{
    protected $fillable = ['name', 'controller', 'action'];
}