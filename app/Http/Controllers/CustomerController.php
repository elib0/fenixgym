<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cliente;
use App\User;
use Validator;

class CustomerController extends Controller
{
    public function index() //funcion para mostrar  la tabla
    {
        $clientes=Cliente::all();
        return view('cliente.index',compact('clientes'));
    }

    // public function profile(Request $request,$usuarios_id=null) //funcion para mostrar formulario
    // {
    //     return view('usuario.form');
    // }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombres' => 'required|max:50',
            'apellidos' => 'required|max:50',
            'email' => 'required|email|max:100|unique:users',
            'password' => 'required|min:6|max:20|confirmed',
            'peso' =>'required|numeric',
            'estatura' =>'required|numeric'
        ]);
    }


    public function profile(Request $request, $user_id=null) //funcion para aguardar en la tabla usuario y cliente
    {
        /*if ($request->isMethod('post')) {
             $validator = $this->validator($request->all());

            if ($validator->fails()) {
                $this->throwValidationException(
                    $request, $validator
                );
            }
            $this->profileSave($request);
            return redirect('customer/all',compact('user'));
        }else{
            $user = $this->profileSave($request);
        }*/
        return view('usuario.form');
    }

    public function profileSave(Request $request){
         /*dd($request->all());*/
        $user_id = null;
        if ($request->has('id')) $user_id = $request->input('id');
        $user=User::firstOrNew([
            'id'=>$user_id
        ])->fill([
            'nombres'=>$request->nombres,
            'apellidos'=>$request->apellidos,
            'fecha_nac'=>$request->fecha_nac,
            'sexo'=>$request->sexo,
            'direccion'=>$request->direccion,
            'telefono'=>$request->telefono,
            'email'=>$request->email,
            'password'=>$request->password,

        ])->save();
        // dd($user);
        $cliente=Cliente::firstOrNew([
            'user_id'=>$user->id,
        ])->fill([
            'direc_factura'=>$request->direc_factura,
            'peso'=>$request->peso,
            'estatura'=>$request->estatura,
            'enfermedades'=>$request->enfermedades,
            'observaciones'=>$request->observaciones,
        ])->save();

        return $user;
    }

}
