<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
     protected $guarded = [];
      protected $dates = [
     'conducted_from',
     'conducted_to',
   ];
      //protected $dateFormat ='Y-m-d H:i';
protected $casts = [
        'age_from' => 'array',
        'age_to' => 'array',
       // 'conducted_at' => 'array',

    ];

}
