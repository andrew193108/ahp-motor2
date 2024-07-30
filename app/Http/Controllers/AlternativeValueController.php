<?php

namespace App\Http\Controllers;

use App\Models\AlternativeValue;
use App\Models\Alternative;
use App\Models\Criteria;
use Illuminate\Http\Request;

class AlternativeValueController extends Controller
{
    public function create()
    {
        $alternatives = Alternative::all();
        $criterias = Criteria::all();
        return view('alternative_values.create', compact('alternatives', 'criterias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alternative_id' => 'required',
            'criteria_id' => 'required',
            'value' => 'required|numeric'
        ]);

        AlternativeValue::create($request->all());
        return redirect()->route('alternative_values.create')
                        ->with('success','Alternative Value created successfully.');
    }
}