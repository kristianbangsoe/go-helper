<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCategories extends Model
{
    public function user()
    {
      return $this->belongsTo('App\User');
    }
}
