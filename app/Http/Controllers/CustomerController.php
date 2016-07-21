<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Customer;
use App\User;
use App\Invoice;
use Validator;

class CustomerController extends Controller
{
    public function index() //funcion para mostrar  la tabla
    {
        $customers=Customer::all();
        return view('customer.index',compact('customers'));
    }

    public function envoice() //funcion para mostrar factura
    {
        // return view('envoice.form');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'email' => 'required|email|max:100|unique:users',
            'password' => 'required|min:6|max:20|confirmed',
            'wheigth' =>'required|numeric',
            'height' =>'required|numeric'
        ]);
    }


    public function profile(Request $request, $customer_id=null) //funcion para aguardar en la tabla usuario y cliente
    {
        $genes = [
            [''=>''],
            ['m'=>'Masculino'],
            ['f'=>'Femenino'],
        ];
        $user = null;
        if ($customer_id) {
            $customer = Customer::find($customer_id);
        }
        // dd([
        //     $customer->without('user')->first()->toArray(),
        //     $customer->user->toArray(),
        //     array_merge($customer->user->toArray(),$customer->without('user')->first()->toArray())
        // ]);
        $customer = collect(array_merge($customer->user->toArray(),$customer->without('user')->first()->toArray()));
        return view('user.form', compact('customer','genes'));
    }

    public function profileSave(Request $request){
        $user_id = null;
        if ($request->has('id')) $user_id = $request->input('id');
        $user=User::firstOrCreate([
            'id'=>$user_id
        ])->fill([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'date_of_birth'=>$request->date_of_birth,
            'sex'=>$request->sex,
            'address'=>$request->address,
            'telephone'=>$request->telephone,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);
        $user_id = $user->id;
        $customer=Customer::firstOrNew([
            'user_id'=>$user_id,
        ])->fill([
            'address_envoice'=>$request->address_envoice,
            'wheigth'=>$request->wheigth,
            'height'=>$request->height,
            'diseases'=>$request->diseases,
            'observations'=>$request->observations,
        ])->save();
        $user->save();
        return redirect('customer/all', $customer);
    }

}
