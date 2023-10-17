<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOrder extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function flowproses() {
        return $this->hasOne(FlowProses::class, 'joborder_id');
    }
}
