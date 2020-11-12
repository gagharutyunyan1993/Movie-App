<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Director
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Director newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Director newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Director query()
 * @mixin \Eloquent
 */
class Director extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function movies()
    {
        return $this->belongsToMany(Movie::class);
    }
}
