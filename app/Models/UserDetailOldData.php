<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetailOldData extends Model
{
    use HasFactory;

    protected $table = 'user_details_old_data';
    
     protected $guarded = [
        'id', 'created_by', 'updated_by'
    ];

    //  protected $fillable = [
    //     'user_detail_id',
    //     'business_name',
    //     'vat_number',
    //     'contact_person',
    //     'pec',
    //     'tax_id_code',
    //     'administrator_name',
    //     'main_activity_ids',
    //     'address',
    //     'house_no',
    //     'region',
    //     'province',
    //     'common',
    //     'pincode',
    //     'storage_capacity',
    //     'order_capacity_limits',
    //     'order_capacity_limits_new',
    //     'available_products',
    //     'geographical_coverage_regions',
    //     'geographical_coverage_provinces',
    //     'time_limit_daily_order',
    //     'bank_transfer',
    //     'bank_check',
    //     'bank',
    //     'rib',
    //     'rid',
    //     'file_operating_license',
    //     // 'updated_by'
    // ];
}
