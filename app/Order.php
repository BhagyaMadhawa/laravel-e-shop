<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ["order_date", "status", "del_date", "price", "first_name", "last_name", "phone", "email"];
}
