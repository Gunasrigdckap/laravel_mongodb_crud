<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class  CustomerMongoDB  extends  Model{
       protected  $connection = 'mongodb';
       protected  $collection = 'laracoll';
       protected  $fillable = ['guid', 'first_name', 'family_name', 'email', 'address'];
}


