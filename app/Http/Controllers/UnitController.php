<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function AllUnit()
    {
        $unit = Unit::latest()->get();
        return view('backend.unit.index', compact('unit'));
       
    }

    public function AddUnit()
    {
        return view('backend.unit.add');
    }

    public function StoreUnit(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:units,name',
        ]);

        Unit::create($request->all());
        $notification = array(
            'message' => 'Unit added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('unit.all')->with($notification);
        
    }

    public function EditUnit($id)
    {
        $unit = Unit::findOrFail($id);
        return view('backend.unit.edit', compact('unit'));
    }

    public function UpdateUnit(Request $request)
    {
        $id = $request->id;
        $unit = Unit::findOrFail($id);
        $unit->update($request->all());

        return redirect()->route('unit.all')->with('success', 'Unit updated successfully.');
    }

    public function DeleteUnit($id)
    {
        $unit = Unit::findOrFail($id);
        $unit->delete();

        return redirect()->route('unit.all')->with('success', 'Unit deleted successfully.');
    }
}