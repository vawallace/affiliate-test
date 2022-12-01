<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Affiliate extends Model
{
    protected $attributes = [
        'affiliate_name' => false,
        'affiliate_id' => false,
        'latitude' => false,
        'longitude' => false,
    ];

}
