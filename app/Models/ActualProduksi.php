<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActualProduksi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function flowproses() {
        return $this->belongsTo(FlowProses::class);
    }

    public function proses() {
        return $this->belongsTo(Proses::class);
    }
}
