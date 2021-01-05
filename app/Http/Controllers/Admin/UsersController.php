<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Admin\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Spatie\Permission\Models\Permission;
use App\Traits\Controllers\ChangeImageTrait;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Input\Input;

class UsersController extends Controller
{
    use ChangeImageTrait;

    const PERMISSIONS = [
        'create' => 'admin-user-create',
        'show' => 'admin-user-show',
        'edit' => 'admin-user-edit',
        'edit-image' => 'admin-user-image',
        'assign-roles' => 'admin-user-role',
        'assign-permissions' => 'admin-user-permission',
    ];

    public function __construct()
    {
        $this->middleware('permission:'.self::PERMISSIONS['create'])->only(['create', 'store']);
        $this->middleware('permission:'.self::PERMISSIONS['show'])->only(['index', 'show']);
        $this->middleware('permission:'.self::PERMISSIONS['edit'])->only(['edit', 'update']);
        $this->middleware('permission:'.self::PERMISSIONS['edit-image'])->only('image');
        $this->middleware('permission:'.self::PERMISSIONS['assign-roles'])->only(['role']);
        $this->middleware('permission:'.self::PERMISSIONS['assign-permissions'])->only(['permission']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate();

        return view('admin.user.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create', [
            'row' => new User()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $status = 'success';
        $content = 'El usuario ha sido creado correctamente';

        DB::beginTransaction();
        try {
            $row = new User();
            $row->fill($request->all());
            $row->password = bcrypt($request->username);

            $row->created_by         = 1; // TODO Eliminar este paso porque obtendra del usuario en sesión
            $row->updated_by         = 1; // TODO Eliminar este paso porque obtendra del usuario en sesión
            $row->save();

            DB::commit();

            return redirect()
                ->route('admin.user.show', $row->id)
                ->with('process_result', [
                    'status' => $status,
                    'content' => $content
                ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            $status = 'error';
            $content = 'Se produjo un error al momento de crear el usuario';

            return redirect()
                ->route('admin.user.create')
                ->withInput($request->all())
                ->with('process_result', [
                    'status' => $status,
                    'content' => $content
                ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.user.show', [
            'row' => $user,
            'roles' => Role::orderBy('name')->get(),
            'permissions' => Permission::orderBy('name')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $status = 'success';
        $content = 'El usuario ha sido actualizado correctamente';

        DB::beginTransaction();
        try {
            $user->fill($request->all())->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            $status = 'error';
            $content = 'Se produjo un error al momento de la actualización del usuario';
        }

        return redirect()
            ->route('admin.user.show', $user->id)
            ->with('process_result', [
                'status' => $status,
                'content' => $content
            ])
        ;
    }

    public function role(Request $request, User $user)
    {
        $status = 'success';
        $content = 'Se asignó correctamente los roles al usuario';

        DB::beginTransaction();
        try {
            $user->roles()->sync($request->roles);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            $status = 'error';
            $content = 'Se produjo un error al momento de la asignación de los roles al usuario';
        }

        return redirect()
            ->route('admin.user.show', $user->id)
            ->with('process_result', [
                'status' => $status,
                'content' => $content
            ])
        ;
    }

    public function permission(Request $request, User $user)
    {
        $status = 'success';
        $content = 'Se asignó correctamente los permisos al usuario';

        DB::beginTransaction();
        try {
           $user->syncPermissions($request->permissions);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            $status = 'error';
            $content = 'Se produjo un error al momento de la asignación de los permisos al usuario';
        }

        return redirect()
            ->route('admin.user.show', $user->id)
            ->with('process_result', [
                'status' => $status,
                'content' => $content
            ])
        ;
    }
}
