<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Role;
use App\User;
use Mail;
class UserController extends Controller
{
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
    {
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
    {
        try{
            $user = new User($request->all());
            $pass=substr(md5(microtime()),1,8);
            $user->password=bcrypt($pass);
            //se modificará para hacer una contraseña aleatoria y mandar un correo con datos
            if($user->save()){
      
              $user->assignRole($request->role);
      
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
    {   
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
       /* $this->validate($request,[
            'primerNombre' => 'required|string|max:50|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
            'segundoNombre' => 'required|string|max:50|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
            'primerApellido' => 'required|string|max:50|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
            'segundoApellido' => 'required|string|max:50|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
            'direccion'=>'string|max:100',
    
          ]);
          */
          try{
             
            $user=User::findOrFail($id);
            $user->update($request->all());
            $user->roles()->sync($request->get('role'));
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
        CONCAT(user.primer_nombre,' ', user.segundo_nombre, ' ' , user.primer_apellido,' ', user.segundo_apellido) as nombre_completo, historia.comentario_de_actividad, historia.created_at FROM historial_actividad as historia
            INNER JOIN users as user
            ON user.id = historia.user_id
            WHERE user.id=".$idUsuario.";";
        $actividades = DB::select(DB::raw($sqlQuery));
        return view('usuario.bitacora', compact('actividades'));
    }
}
