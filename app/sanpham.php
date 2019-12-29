<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sanpham extends Model
{
    //
    protected $table = "sanpham";
    public $timestamps = false;

    public function loaisanpham(){
        return $this->belongsTo('App\LoaiSanPham','id_loaisanpham','id');
    }
}
