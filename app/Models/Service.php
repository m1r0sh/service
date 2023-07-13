<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public function executor()
    {
        return $this->belongsTo(Executor::class);
    }

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class);
    }
}
