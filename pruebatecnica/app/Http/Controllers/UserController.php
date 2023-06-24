<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Retornamos todos los datos contenidos en la BD "users"
    public function index(){

        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    // Guardamos nuevos usuarios
    public function store(Request $request)
    {
        $inputs=$request->input();
        
        $inputs["password"]=Hash::make(trim($request->password)); // Encriptamos la contraseña y borramos espacios en blanco

        $respuesta=User::create($inputs);
        return $respuesta;
    }

    /**
     * Display the specified resource.
     */

    //Autenticacion

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Autenticación exitosa

            // Obtener el usuario autenticado
            $user = Auth::user();
  


            return response()->json([
                'user' => $user,
                'token'=>$user->id,
                'message' => 'Usuario autenticado correctamente',
            ]);
        } else {
            // Autenticación fallida
            return response()->json([
                'error' => true,
                'message' => 'Credenciales inválidas',
            ], 401);
        }
    }

    // Consultamos un usuario en especifico
    public function show(string $id)
    {
        $existeDoc=User::find($id);
        if(isset($existeDoc)){

                return response()->json([
                    'data'=>$existeDoc,
                    'mensaje'=>"User encontrado con exito"
                ]);
            

        }else{
            return  response()->json([
                'error'=>true,
                'mensaje'=>"User no encontrado con doc_id=".$id,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    // Actualizamos Usuario
    //en este caso se realizara la actualizacion de doc_codigo
    public function update(Request $request,$id){
        $existeDoc=User::find($id);
        if(isset($existeDoc)){
            $existeDoc->first_name=$request->first_name;
            $existeDoc->last_name=$request->last_name;
            $existeDoc->email=$request->email;
            $existeDoc->password= Hash::make($request->password) ; // Encriptamos la contraseña
            
            
            
            if($existeDoc->save()){ //Validamos si el usuario fue actualizado
                return response()->json([
                    'data'=>$existeDoc,
                    'mensaje'=>"Usuario actualizado con exito"
                ]);
            }

        }else{
            return  response()->json([
                'error'=>true,
                'mensaje'=>"Usuario no actualizado con doc_id=".$id,
            ]);
        }

        //return isset($existe);//isset(): me permite saber si la variable tiene algun valor
    }

    /**
     * Remove the specified resource from storage.
     */
    // Eliminamos un usuario
    public function destroy(string $id)
    {
        $existeDoc=User::find($id);
        if(isset($existeDoc)){
                $del=User::destroy($id);//Respuesta booleana de accion eliminar
                
                if($del){
                    return response()->json([
                        'data'=>$existeDoc, // retornamos los datos del documento eliminado
                        'mensaje'=>"User eliminado con exito"
                    ]);
                }else{
                    return response()->json([
                        'data'=>$existeDoc,
                        'mensaje'=>"User no existe"
                    ]);
                }
                
            

        }else{
            return  response()->json([
                'error'=>true,
                'mensaje'=>"User no encontrado con doc_id=".$id,
            ]);
        }
    }
}
