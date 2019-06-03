<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class Post extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'worker_id' => $this->worker_id,
            'category_id' => $this->category_id,
            'rating' => $this->rating,
            'rating_comment' => $this->rating_comment,
            'title' => $this->title,
            'body' => $this->body,
            'name' => $this->user->name,
            'avatar' => '/uploads/avatars/' . $this->user->avatar,
            'user_id' => $this->user_id,
            'date' => $this->created_at->diffForHumans()
        ];
    }
    public function user()
    {
      return $this->belongsTo('App\User');
    }
}
