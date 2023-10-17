<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proses extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function flowprosesdetails() {
        return $this->hasMany(FlowProsesDetail::class);
    }

    public function actuals() {
        return $this->hasMany(ActualProduksi::class);
    }
}
