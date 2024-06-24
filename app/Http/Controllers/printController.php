<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ShippingPermit;
use PDF;
use Illuminate\Http\Request;
use Rmunate\Utilities\SpellNumber;
use App\Core\Helpers\TranslateTextHelper;

class printController extends Controller
{
    public function index($slug)
    {
        $testprint = ShippingPermit::query()
            ->with([
//                "portOfOrigin",
//                "portOfDestination",
                "spMIll_Origin",
            ])
            ->where('slug', $slug)
            ->first();

        // Handle null value for sp_volume
        $spVolume = optional($testprint)->sp_volume ?? 0;  // Default to 0 if sp_volume is null
        $word = SpellNumber::integer($spVolume)->toLetters();
        $translated = TranslateTextHelper::translate($word);

        return view('printables.testprint')->with([
            "test" => $testprint,
            'translated' => $translated,
        ]);
    }




}
