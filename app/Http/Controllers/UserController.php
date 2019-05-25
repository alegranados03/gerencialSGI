<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\User;
use Mail;

class UserController extends Controller
{
  /* método que registra la acción hecha por el usuario 
    en el historial de actividades */
  public function registrarEnBitacora($idUser,$accion) {
    $fecha = new \DateTime('now');
    DB::table('historial_actividad')
    ->insert(['user_id' => $idUser ,
              'created_at'=>$fecha->format( 'Y-m-d H:i:s'),
              'comentario_de_actividad'=>$accion
                                   ]);
}

public function generarUsername($nombre_completo): String{
  $nombre_apellido=explode(" ",ucwords($nombre_completo));
  $fecha = getdate();
  $username=substr($nombre_apellido[0],0,3);
  foreach($nombre_apellido as $elemento){
  $username=$username.$elemento[0];
  }
  return $username.$fecha['mday'].$fecha['mon'].substr($fecha['year'],2,2);
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   //Registro en bitacora
      $comentario="Accedió a la pantalla de Registrar un nuevo usuario.";
      $this->registrarEnBitacora(Auth::user()->id,$comentario);
      //fin
        $roles = Role::all();
        return view('usuario.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {         $this->validate($request,[
      'primer_nombre'   => 'required|string|max:50|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
      'segundo_nombre'  => 'required|string|max:50|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
      'primer_apellido' => 'required|string|max:50|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
      'segundo_apellido'=> 'required|string|max:50|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
      'email'           => 'required|string|email|max:100|unique:users',
            ]);



        try{
            $user = new User($request->all());
            $pass=substr(md5(microtime()),1,8);
            $user->password=bcrypt($pass);
            $nombre_completo=$user->primer_nombre." ".$user->segundo_nombre.
            " ".$user->primer_apellido." ".$user->segundo_apellido;
            $user->username=$this->generarUsername(ucwords($nombre_completo));
            //se modificará para hacer una contraseña aleatoria y mandar un correo con datos
            if($user->save()){

               //Registro en bitacora
              $comentario="Registró al nuevo usuario de correo: ".$user->email."";
              $this->registrarEnBitacora(Auth::user()->id,$comentario);
              //fin
              $user->assignRole($request->role);
              $rol=Role::findOrFail($request->role);
              if($rol->name=='Suspendido'){
                $user->activo=0;
                $user->update();
              }else{
                $user->activo=1;
                $user->update();
              }

              Mail::send('usuario.email.usuario',['user'=>$user,'pass' => $pass ], function ($m) use ($user){
                    $m->to($user->email,$user->primer_nombre);
                    $m->subject('Contraseña y nombre de usuario');
                    $m->from('panonline503@gmail.com','Panadería Lila');
                                                        });
            }

           return redirect()->route('home')->with('success','Usuario registrado correctamente');
          }catch(Exception $e){
            return back()->with('danger','Usuario no registrado, es posible que el usuario ya se encuentre registrado');
          }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {      //Registro en bitacora
           $comentario="Accedió a la pantalla de editar usuario.";
           $this->registrarEnBitacora(Auth::user()->id,$comentario);
           //fin
        $user=User::findOrFail($id);
        $Rolu=Role::join('role_user', 'roles.id', '=', 'role_user.role_id')
        ->where('role_user.user_id','=',$user->id)
        ->select('roles.id')->get();

        foreach($Rolu as $rol){
          $idRol=$rol->id;
        }


      $roles=Role::all();

        return view('usuario.update',compact('user','roles','idRol'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request,[
        'primer_nombre'   => 'required|string|max:50|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
        'segundo_nombre'  => 'required|string|max:50|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
        'primer_apellido' => 'required|string|max:50|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
        'segundo_apellido'=> 'required|string|max:50|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
        'email'           => 'required|string|email|max:100',
              ]);
          try{

            $user=User::findOrFail($id);
            $user->update($request->all());
            $user->roles()->sync($request->get('role'));
            $rol=Role::findOrFail($request->get('role'));
            if($rol->name=='Suspendido'){
              $user->activo=0;
              $user->update();
            }else{
              $user->activo=1;
              $user->update();
            }
             //Registro en bitacora
             $comentario="Editó datos al usuario de correo: ".$user->email."";
             $this->registrarEnBitacora(Auth::user()->id,$comentario);
             //fin

          return redirect()->route('home')->with('success','Actualizado con éxito');
          }catch(Exception $e){
            return back()->with('danger','Usuario no editado,revise los datos proporcionados');
          }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }





    public function bitacoraUsuarios($idUsuario){
        $sqlQuery = "SELECT
        CONCAT(user.primer_nombre,' ', user.segundo_nombre, ' ' , user.primer_apellido,' ', user.segundo_apellido)
        as nombre_completo, historia.comentario_de_actividad, historia.created_at FROM historial_actividad as historia
            INNER JOIN users as user
            ON user.id = historia.user_id
            WHERE user.id=".$idUsuario." ORDER BY historia.created_at DESC;";
        $actividades = DB::select(DB::raw($sqlQuery));
        return view('usuario.bitacora', compact('actividades'));
    }



    public function editPassword()
    {         //Registro en bitacora
              $comentario="Ingresó a la vista de editar contraseña";
              $this->registrarEnBitacora(Auth::user()->id,$comentario);
              //fin
                   try{
                  $user = User::findOrFail(Auth::user()->id);
                  return view('usuario.updatePassword')->with("user",$user);
             }catch(Exception $e){
                 return "Error al intentar modificar al Usuario".$e->getMessage();
             }

    }




    public function actualizarPassword(Request $request){
      $this->validate($request,[
        'old_password' => 'required|string',
        'password' => 'required_with:password_confirmation|same:password_confirm|string|min:8',
      ]);


      $user=User::findOrFail(Auth::user()->id);
      $almacenada=$user->password;
      $recibida=$request->old_password;

      if (Hash::check($recibida, $almacenada)) {
        $nueva_password=$request->password;
        $user->password=bcrypt($nueva_password);
        $user->save();
         //Registro en bitacora
         $comentario="Editó/Cambió exitosamente la contraseña";
         $this->registrarEnBitacora(Auth::user()->id,$comentario);
         //fin
        return redirect()->route('home')->with('success','Contraseña actualizada con éxito');


      }else{
                 //Registro en bitacora
                 $comentario="Intentó cambiar a una nueva contraseña, pero la contraseña actual era incorrecta";
                 $this->registrarEnBitacora(Auth::user()->id,$comentario);
                 //fin
        return redirect()->back()->with('danger','La contraseña actual no es correcta, intente nuevamente');
      }

    }

    public function verAvanzada(){
      return view('usuario.etl.avanzada');
    }

    public function ejecutarAvanzada($accion){
       if($accion=='Backup'){return redirect()->route('respaldo');}
       if($accion=='ETL'){return redirect()->route('ETL');}
       if($accion=='Restore'){ return redirect()->route('restauracion');}
       
    }
}
