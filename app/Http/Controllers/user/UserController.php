<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\UserCreateRequest;

class UserController extends Controller
{
    /**
    *
    * Store the User
    * @return json Object
    * @param request user data
    * @method POST
    *
    */
    public function store(UserCreateRequest $request)
    {
        try {
            $user = new User();
            $user->fill($request->all());
            $user->password = bcrypt($request->password);
            $user->save();
        } catch (\Exception $e) {
            return response()->json([
              'ok'      =>false,
              'error'   => $e->getMessage(),
              'mensaje' =>'Error al intentar guardar el nuevo usuario',
            ], 500);
        }
        // Autenticacion automatica despues del registro
        // $credentials = request(['email', 'password']);
        // if ($token = auth()->attempt($credentials)) {
        //     return response()->json([
        //       'ok'  =>true,
        //       'mensaje'=> 'Usuario Creado correctamente',
        //       'user'=> $user,
        //       'token'=> $token
        //     ], 201);
        // }
        return response()->json([
          'ok'  =>true,
          'mensaje'=> 'Usuario Creado correctamente',
          'user'=> $user
        ], 201);
    }
    /*---------------------------------------------------------------------------------------*/
    /**
    *
    * List the Users
    * @return list
    * @param null
    * @method GET
    *
    */
    public function userList($parametro, $palabra = NULL)
    {
      $permitidas = ['todos', 'activos', 'inactivos'];
      if ( ! in_array($parametro, $permitidas) ) {
        return response()->json([
          'ok' => false,
          'users' => null,
          'error' => ['busqueda' => 'Los parametros permitidos son "todos", "activos" e "inactivos"']
          ], 400);
      }

        try {
            switch ($parametro) {
                case 'todos':
                    $users = User::withTrashed();
                    break;
                case 'inactivos':
                    $users = User::onlyTrashed();
                    break;
                case 'activos':
                    $users = User::select('*');
            }
            if($parametro != 'inactivos'){
                $users = $users->where('email', 'like', '%'.$palabra.'%')
                      ->orWhere('name', 'like', '%'.$palabra.'%')
                      ->orWhere('type', 'like', '%'.$palabra.'%')
                      ->orWhere('telefono', 'like', '%'.$palabra.'%')
                      ->orderBy('name');
                }
            $users =  $users->paginate(5);
            $total = $users->count();

          return response()->json([
            'ok' => true,
            'total'=>$total,
            'users' => $users
          ], 200);
        } catch (\Exception $e) {
          return response()->json([
            'ok' => false,
            'users' => null,
            'error' => ['busqueda' => 'Error al buscar usuarios en el sistema']
          ], 500);
            }
    }
    /*---------------------------------------------------------------------------------------*/
    /**
     *
     * PUT method, update User for id
     * @param $request
     * @param $idUser
     * @return Collection with user
     *
     */
    public function update(Request $request, $idUser)
    {
        $user = User::find($idUser);


        if (!$user) {
            return response()->json([
        'ok'=>false,
        'user'=>null,
        'error'=> ['usuario'=>'No existe usuario con ese ID']
      ], 204);
        }

        $user->fill($request->all());

        $user->save();

        return response()->json([
      'ok'=>true,
      'user'=>$user,
      'mensaje'=>'El usuario se actualizo corectamente'
    ], 202);
    }
    /*---------------------------------------------------------------------------------------*/
    /**
     *
     * DELETE method, delete user from database
     * @param $idUser
     * @return Collection the deleted user
     *
     */
    public function delete($idUser)
    {
        $user = User::find($idUser);
        if (!$user) {
          return response()->json([
            'ok'=>false,
            'error'=>['mensaje'=>'No existen usuarios registrados con el id '. $idUser],
            'user'=>null
          ], 400);
        }

        $user->delete();
        
        return response()->json([
        'ok'=>true,
        'user'=>$user
      ], 202);
    }
    /*---------------------------------------------------------------------------------------*/
    /**
     *
     * GET method, show user from database
     * @param $idUser
     * @return Collection the user find
     *
     */
    public function show ( $id ) {
      $user = User::find( $id );
      if( !$user ){
        return response()->json([
          'ok'  => false,
          'error' => ['mensaje' => 'No existen usuarios registrados con el id '.$id],
          'user'  => null
        ], 400);
      }

        return response()->json([
          'ok' => true,
          'user' => $user
        ], 200);
    }
    /*---------------------------------------------------------------------------------------*/
    /**
     *
     * GET method, show user from database
     * @param $idUser
     * @return Collection the user find
     *
     */
    public function reactivar ( Request $request ) {
      // return $request->id;
      $user = User::onlyTrashed()
        ->where('id', $request->id)
        ->first();
      // return $user;
      if( !$user ){
        return response()->json([
          'ok'  => false,
          'error' => ['mensaje' => 'No existen usuarios registrados con el id '.$request->id],
          'user'  => null
        ], 400);
      }
      $user->restore();
      return response()->json([
        'ok' => true,
        'user' => $user
      ], 200);
    }

    /*---------------------------------------------------------------------------------------*/
    /**
    *
    * List the Users
    * @return list
    * @param null
    * @method GET
    *
    */
    public function userRegister()
    {
         try {
            $users = User::select('*')
              ->orderBy('name')
              ->get();


            return response()->json([
        'ok' => true,
        'users' => $users
      ], 200);
        } catch (\Exception $e) {
            return response()->json([
        'ok' => false,
        'users' => null,
        'error' => ['busqueda' => 'Error al buscar usuarios en el sistema']
      ], 500);
        }
    }
}
