<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Tecnology extends Model
{
    use HasFactory;

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    protected $fillable = [
        'name'
    ];
}
