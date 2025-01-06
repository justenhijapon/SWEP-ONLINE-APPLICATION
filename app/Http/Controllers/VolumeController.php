<?php

namespace App\Http\Controllers;

use App\Models\Consignee;
use App\Models\Mill;
use App\Models\MillUtilization;
use App\Models\OfficialReciepts;
use App\Models\Trader;
use App\Models\User;
use App\Models\Vessel;
use Illuminate\Http\Request;
use App\Modls\VolumeModel;

class VolumeController extends Controller
{
    public function store(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'crop_year.*' => 'required|string',
            'sro_number.*' => 'required|string',
            'amount.*' => 'required|numeric',
        ]);

        // Loop through and save the data
        foreach ($request->crop_year as $index => $cropYear) {
            YourModel::create([
                'crop_year' => $cropYear,
                'sro_number' => $request->sro_number[$index],
                'amount' => $request->amount[$index],
            ]);
        }

        return redirect()->back()->with('success', 'Data stored successfully!');
    }
}