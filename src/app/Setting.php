<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    const DIRECTION_TYPE = [
        'none' => 0,
        'north' => 1,
        'east' => 2,
        'south' => 3,
        'west' => 4
    ];

    const DIRECTION_ANGLE = [
        0 => ['min' => 0, 'max' => 360],
        1 => [['min' => 0, 'max' => 90], ['min' => 270, 'max' => 360]],
        2 => ['min' => 0, 'max' => 180],
        3 => ['min' => 90, 'max' => 270],
        4 => ['min' => 180, 'max' => 360],
    ];

    const LAT = [
        'min' => -90,
        'max' => 90,
    ];

    const LNG = [
        'min' => -180,
        'max' => 180,
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function settingHistory()
    {
        return $this->hasMany(SettingHistory::class);
    }
}
