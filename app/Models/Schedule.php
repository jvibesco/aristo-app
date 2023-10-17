<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function flowprosesdetail() {
        return $this->belongsTo(FlowProsesDetail::class, 'flow_proses_detail_id');
    }

    public function flowproses() {
        return $this->belongsTo(FlowProses::class);
    }
    
}
