<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function joborders() {
        return $this->hasMany(JobOrder::class);
    }

}
