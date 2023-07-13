<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'start_date',
        'end_date',
        'executor_id',
        'service_type_id'
    ];

    public function executor()
    {
        return $this->hasOne(Executor::class, 'id', 'executor_id');
    }

    public function serviceType()
    {
        return $this->hasOne(ServiceType::class, 'id', 'service_type_id');
    }
}
