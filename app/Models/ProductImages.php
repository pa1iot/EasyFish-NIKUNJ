<?php

namespace ZigKart\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class ProductImages extends Model
{
    
	/* product images */
	
  
    protected $table = 'product_images';
	
	public function Product(){
      return $this->belongsTo(Product::class);
   }
	
  
  
  
  
}
