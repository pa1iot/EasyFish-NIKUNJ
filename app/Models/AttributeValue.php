<?php

namespace ZigKart\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class AttributeValue extends Model
{
    
	/* attribute */
	
	protected $table = 'product_attribute_value';
	
  
  
  public function Attribute(){
      return $this->belongsTo(Attribute::class);
   }
   
   
  
}
