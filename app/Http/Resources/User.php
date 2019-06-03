<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use App\Category;
use DB;


use Illuminate\Support\Facades\Auth;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function toArray($request)
    {
        $categories = DB::select('SELECT * FROM user_categories WHERE user_id =' . $this->id);


        $user_categories = DB::select('SELECT user_categories.category_id AS id, 
        categories.name, user_categories.experince, user_categories.description  
        FROM categories 
        INNER JOIN user_categories
        ON user_categories.category_id = categories.id
        WHERE user_id =' . $this->id);
  
        return [
            'id' => $this->id,
            'name' => $this->name,
            'lastname' => $this->lastname,
            'zip' => $this->zip,
            'street' => $this->street,
            'phone' => $this->phone,
            'city' => $this->city,
            'lat' => $this->lat,
            'lon' => $this->lon,
            'avatar' => '/uploads/avatars/' . $this->avatar,
            'birth' => \Carbon\Carbon::parse($this->birth)->age,
            'categories' => $categories,
            'user_categories' => $user_categories,
            'bio' => $this->bio
        ];
    }
}
