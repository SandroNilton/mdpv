<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use sirajcse\UniqueIdGenerator\UniqueIdGenerator;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Procedure extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    public function type_procedure()
    {
        return $this->belongsTo(TypeProcedure::class, 'type_procedure_id', 'id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public static function boot() { 
        parent::boot(); 
        self::creating(function ($model) { 
            $prefix = 'CAPRL'.Carbon::now()->year;
            $model->id = UniqueIdGenerator::generate(['table' => 'procedures', 'length' => 15, 'prefix' =>$prefix, 'reset_on_change'=>'prefix']); 
        }); 
    }
}