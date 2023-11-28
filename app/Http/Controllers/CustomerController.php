<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerAddress;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function checkEmail(Request $request)
    {
        $email = $request->input('email');
        $exists = Customer::where('email', $email)->exists();
        return response()->json(['exists' => $exists]);
    }
    public function checkPhone(Request $request)
    {
        $phone = $request->input('phone');
        $exists = Customer::where('phone', $phone)->exists();
        return response()->json(['exists' => $exists]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:customers',
            'phone' => 'required|max:10|min:10|unique:customers',
            'address' => 'required',
            'pincode' => 'required',
        ]);
        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
        $customer_address = CustomerAddress::create([
            'customer_id' => $customer->id,
            'address' => $request->address,
            'pincode' => $request->pincode,
        ]);
        if ($customer_address->save()) {
            return back()->with('success', 'Customer added successfully');
        }
        return back()->with('error','Something Went Wrong!!');
    }
}
