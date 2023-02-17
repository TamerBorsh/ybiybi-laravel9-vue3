<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function getCountry()
    {
        $country = Country::select('id', 'name_ar')->whereStatus('1')->get();
        return response()->json(['countries' => $country]);
    }
}
