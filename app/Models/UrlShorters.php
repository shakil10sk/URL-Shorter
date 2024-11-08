<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrlShorters extends Model
{
    use HasFactory;
    protected $table = 'url_shorter';
}
