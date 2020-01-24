<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
