<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class locationController extends Controller
{
    public function getCities($province_id)
    {
        $cities=City::query()->where('province_id',$province_id)->pluck('city','id');

        return response()->json($cities);
    }
}
