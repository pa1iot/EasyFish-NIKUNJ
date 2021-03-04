<?php

namespace ZigKart\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Auth;

class Import extends Model
{

   protected $table = 'product';
   public $timestamps = false;
   
   protected $fillable = [
            'product_id',
            'user_id',
            'product_token',
            'product_name',
            'product_sku',
			'product_slug',
			'product_category',
			'product_short_desc',
			'product_desc',
			'product_price',
			'product_offer_price',
			'product_image',
			'product_return_policy',
			'product_video_url',
			'product_allow_seo',
			'product_seo_keyword',
			'product_seo_desc',
			'product_estimate_time',
			'product_condition',
			'product_brand',
			'product_tags',
			'product_featured',
			'product_type',
			'product_file',
			'product_external_url',
			'product_local_shipping_fee',
			'product_global_shipping_fee',
			'product_attribute_type',
			'product_attribute',
			'product_stock',
			'flash_deals',
			'flash_deal_start_date',
			'flash_deal_end_date',
			'product_date',
			'product_status',
			'token',
			'language_code',
			'product_page_parent',
			'product_drop_status'
      
    ];
   
   
  
  
  
}
