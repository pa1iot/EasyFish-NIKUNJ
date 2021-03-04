<?php

namespace ZigKart\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Auth;
use ZigKart\Models\Import;
use ZigKart\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportProduct implements ToModel
{

  
   
	
   public function model(array $row)
    {
	     
	    
           $data = Product::findProduct($row[2],$row[36]);
           if (empty($data)) {
		              if(!empty($row[10])){ $offer_price = $row[10]; } else { $offer_price = 0; }
					  if(!empty($row[30])){ $flash_deals = $row[30]; } else { $flash_deals = 0; }
					  if(!empty($row[37]))
					  {
					   $product_page_parent = $row[37]; 
					  } 
					  else 
					  {
					   $product_page_parent = 0; 
					  }
					  if(!empty($row[14])){ $product_allow_seo = $row[14]; } else { $product_allow_seo = 0; }
					  if(!empty($row[18])){ $product_condition = $row[18]; } else { $product_condition = ""; }
					  if(!empty($row[25])){ $product_local_shipping_fee = $row[25]; } else { $product_local_shipping_fee = 0; }
					  if(!empty($row[26])){ $product_global_shipping_fee = $row[26]; } else { $product_global_shipping_fee = 0; }
					  if(!empty($row[21])){ $product_featured = $row[21]; } else { $product_featured = 0; }
					  return new Import([
					   'user_id'    => $row[1], 
					   'product_token' => $row[2],
					   'product_name' => $row[3],
					   'product_sku' => $row[4],
					   'product_slug' => $row[5],
					   'product_category' => $row[6],
					   'product_short_desc' => $row[7],
					   'product_desc' => $row[8],
					   'product_price' => $row[9],
					   'product_offer_price' => $offer_price,
					   'product_image' => $row[11],
					   'product_return_policy' => $row[12],
					   'product_video_url' => $row[13],
					   'product_allow_seo' => $product_allow_seo,
					   'product_seo_keyword' => $row[15],
					   'product_seo_desc' => $row[16],
					   'product_estimate_time' => $row[17],
					   'product_condition' => $product_condition,
					   'product_brand' => $row[19],
					   'product_tags' => $row[20],
					   'product_featured' => $product_featured,
					   'product_type' => $row[22],
					   'product_file' => $row[23],
					   'product_external_url' => $row[24],
					   'product_local_shipping_fee' => $product_local_shipping_fee,
					   'product_global_shipping_fee' => $product_global_shipping_fee,
					   'product_attribute_type' => $row[27],
					   'product_attribute' => $row[28],
					   'product_stock' => $row[29],
					   'flash_deals' => $flash_deals,
					   'flash_deal_start_date' => $row[31],
					   'flash_deal_end_date' => $row[32],
					   'product_date' => $row[33],
					   'product_status' => $row[34],
					   'token' => $row[35],
					   'language_code' => $row[36],
					   'product_page_parent' => $product_page_parent,
					   'product_drop_status' => $row[38],
					]);
					
					
					
		  
              } 
     
	    
	
        
    }
   
   
  
  
}
