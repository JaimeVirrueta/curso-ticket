<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Admin\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Spatie\Permission\Models\Permission;
use App\Traits\Controllers\ChangeImageTrait;

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
            // 'row' => $user
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
        $row = new User();
        $row->fill($request->all());
        $row->password = bcrypt($request->username);


        $row->created_by         = 1; // TODO Eliminar este paso porque obtendra del usuario en sesión
        $row->updated_by         = 1; // TODO Eliminar este paso porque obtendra del usuario en sesión
        $row->save();

        return redirect()->route('admin.user.show', $row->id);
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
        $user->fill($request->all())->save();

        return redirect()->route('admin.user.show', $user->id);
    }

    public function role(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);

        return redirect()->route('admin.user.show', $user->id);
    }

    public function permission(Request $request, User $user)
    {
        $user->syncPermissions($request->permissions);

        return redirect()->route('admin.user.show', $user->id);
    }
}
