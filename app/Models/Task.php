<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
        protected $fillable = ['description', 'user_id', 'completed', 'user_name'];
        public function user()
{
    return $this->belongsTo(User::class);
}


}
