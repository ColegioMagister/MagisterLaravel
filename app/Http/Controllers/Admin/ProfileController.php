<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\UserSettings;
use App\Models\{User,Roles};

use Illuminate\Support\Facades\Auth; //Necesario
use Illuminate\Support\Facades\Hash; //Necesario
use Illuminate\Support\Facades\DB; //Necesario

class ProfileController extends Controller
{


    public function index()
    {
        return view ('user.profile');
    }
    
    
    
    public function NewPassword()
    {
        return view ('user.editprofile');
    }




    public function changePassword(Request $request){    
        
        $user           = Auth::user();
        $userId         = $user->id;
        $userEmail      = $user->email;
        $userPassword   = $user->password;

        if($request->password_actual !=""){
            $NuewPass   = $request->password;
            $confirPass = $request->confirm_password;
            $username       = $request->username;

                //Verifico si la clave actual es igual a la clave del usuario en session
                if (Hash::check($request->password_actual, $userPassword)) {

                    //Valido que tanto la 1 como 2 clave sean iguales
                    if($NuewPass == $confirPass){
                        //Valido que la clave no sea Menor a 6 digitos
                        if(strlen($NuewPass) >= 6){
                            $user->password = Hash::make($request->password);
                            $sqlBD = DB::table('users')
                                  ->where('id', $user->id)
                                  ->update(['password' => $user->password], ['username' => $user->username]);
                    
                            return redirect()->back()->with('updateClave','La clave fue cambiada correctamente.');
                        }else{
                            return redirect()->back()->with('clavemenor','Recuerde la clave debe ser mayor a 6 digitos.');
                        }
        
                }else{
                    return redirect()->back()->with('claveIncorrecta','Por favor verifique las claves no coinciden.');
                }
           
            }else{
                return back()->withErrors(['password_actual'=>'La Clave no Coinciden']);
            }


        }else{
            $username       = $request->username;
            $sqlBDUpdateName = DB::table('users')
                            ->where('id', $user->id)
                            ->update(['username' => $username]);
            return redirect()->back()->with('username','El nombre fue cambiado correctamente.');;
        }
    }



    

}
