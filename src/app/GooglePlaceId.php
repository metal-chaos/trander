<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GooglePlaceId extends Model
{
    /**
     * Get google place infomation
     *
     * @param string $id
     * @return self
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public static function get_information(string $id)
    {
        return self::where('place_id', $id)
            ->firstOrFail([
                'name',
                'icon',
                'rating',
                'photo',
                'vicinity',
                'user_ratings_total',
                'price_level',
                'lat',
                'lng',
                'rating_star',
            ]);
    }
}
