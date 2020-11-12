<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Actor
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Actor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Actor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Actor query()
 * @mixin \Eloquent
 */
class Actor extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function movies()
    {
        return $this->belongsToMany(Movie::class);
    }
}
