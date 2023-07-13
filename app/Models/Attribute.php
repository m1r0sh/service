<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'description',
        'service_type_id'
    ];

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class);
    }
}
