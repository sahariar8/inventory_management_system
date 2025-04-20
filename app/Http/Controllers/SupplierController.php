<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    public function AllSupplier()
    {
        $allSupplier = Supplier::latest()->get();
        return view('backend.supplier.index',compact('allSupplier'));
    }

    public function AddSupplier()
    {
        return view('backend.supplier.add');
    }

    public function StoreSupplier(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|min:3',
            'email'=>'required|email',
            'mobile_no'=>'required|digits:11|unique:suppliers,mobile_no',
            'address'=>'required',  
        ]);
        
        $data['created_by'] = Auth::id();
        
        Supplier::create($data);
        $notification = array(
            'message' => 'Supplier added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('supplier.all')->with($notification);
    }

    public function EditSupplier($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('backend.supplier.edit',compact('supplier'));
    }
    
    public function UpdateSupplier(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|min:3',
            'email'=>'required|email',
            'mobile_no'=>'required|digits:11',
            'address'=>'required',
        ]);
        $data['updated_by'] = Auth::id();
        
        $supplier = Supplier::findOrFail($request->id);
        $supplier->update($data);
        
        $notification = array(
            'message' => 'Supplier Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('supplier.all')->with($notification);
    }

    public function DeleteSupplier($id)
    {
        Supplier::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Supplier Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}