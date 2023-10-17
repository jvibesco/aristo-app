<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlowProses extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function joborder()
    {
        return $this->belongsTo(JobOrder::class);
    }

    public function flowprosesdetails() {
        return $this->hasMany(FlowProsesDetail::class, 'flowproses_id');
    }

    public function material() {
        return $this->belongsTo(Material::class);
    }

    public function schedules() {
        return $this->hasMany(Schedule::class, 'flowproses_id');
    }

    public function actuals() {
        return $this->hasMany(ActualProduksi::class, 'flowproses_id');
    }

   
}
