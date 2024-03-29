<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function type_procedure()
    {
      return $this->belongsToMany(TypeProcedure::class);
    }
}