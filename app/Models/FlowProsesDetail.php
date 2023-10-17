<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlowProsesDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function flowproses()
    {
        return $this->belongsTo(FlowProses::class, 'flowproses_id');
    }

    public function proses()
    {
        return $this->belongsTo(Proses::class);
    }

    public function schedule()
    {
        return $this->hasOne(Schedule::class);
    }
}
