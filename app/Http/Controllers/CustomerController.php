<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;




class CustomerController extends Controller
{
    public function AllCustomer()
    {
        $allCustomer = Customer::latest()->get();
        return view('backend.customer.index',compact('allCustomer'));
    }

    public function AddCustomer()
    {
        return view('backend.customer.add');
    }

    public function StoreCustomer(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|min:3',
            'email'=>'required|email',
            'mobile_no'=>'required|digits:11|unique:customers,mobile_no',
            'address'=>'required',
            'image'=>'required|mimes:jpg,jpeg,png',  
        ]);
        $image = $request->file('image');

        if (isset($image)) {
            $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $savePath = public_path('upload/customer/' . $imageName);
        
            $image = ImageManager::gd()->read($image);
            $image->resize(300, 200);
            $image->save($savePath); 
        
            $data['image'] = 'upload/customer/' . $imageName;
        }
        
        $data['created_by'] = Auth::id();
        
        Customer::create($data);
        $notification = array(
            'message' => 'Customer added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('customer.all')->with($notification);
    }

    public function EditCustomer($id)
    {
        $customer = Customer::findOrFail($id);
        return view('backend.customer.edit',compact('customer'));
    }
    
    public function UpdateCustomer(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|min:3',
            'email'=>'required|email',
            'mobile_no'=>'required|digits:11',
            'address'=>'required',
        ]);
        
        
        $id = $request->id;
        $customer = Customer::findOrFail($id);
        if($request->hasFile('image')){
            if(file_exists($customer->image)){
                unlink($customer->image);
            }
            $image = $request->file('image');
            $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $savePath = public_path('upload/customer/' . $imageName);
            $image = ImageManager::gd()->read($image);
            $image->resize(300, 200);
            $image->save($savePath);
            $data['image'] = 'upload/customer/' . $imageName;
        } else {
            $data['image'] = $customer->image;
        }
        $data['updated_by'] = Auth::id();
        $customer->update($data);
        $notification = array(
            'message' => 'Customer Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('customer.all')->with($notification);
    }

    public function DeleteCustomer($id)
    {
        Customer::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Customer Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}