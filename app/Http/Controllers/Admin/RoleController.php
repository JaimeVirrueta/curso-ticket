<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    const PERMISSIONS = [
        'create' => 'admin-role-create',
        'show' => 'admin-role-show',
        'edit' => 'admin-role-edit',
        'delete' => 'admin-role-delete',
    ];

    public function __construct()
    {
        $this->middleware('permission:'.self::PERMISSIONS['create'])->only(['create', 'store']);
        $this->middleware('permission:'.self::PERMISSIONS['show'])->only(['index', 'show']);
        $this->middleware('permission:'.self::PERMISSIONS['edit'])->only(['edit', 'update']);
        $this->middleware('permission:'.self::PERMISSIONS['delete'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Role::orderBy('name')->paginate();

        return view('admin.role.index', [
            'rows' => $rows,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role.create', [
            'row' => new Role(),
            'permissions' => Permission::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $status = 'success';
        $content = 'El rol ha sido creado correctamente';

        DB::beginTransaction();
        try {
            $row = new Role($request->all());
            $row->save();

            $row->permissions()->sync($request->permission);

            DB::commit();

            return redirect()
                ->route('admin.role.show', $row->id)
                ->with('process_result', [
                    'status' => $status,
                    'content' => $content
                ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            $status = 'error';
            $content = 'Se produjo un error al momento de crear el rol';

            return redirect()
                ->route('admin.role.create')
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
    public function show(Role $role)
    {
        return view('admin.role.show', [
            'row' => $role->load('permissions', 'users')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('admin.role.edit', [
            'row' => $role,
            'permissions' => Permission::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $status = 'success';
        $content = 'El rol ha sido actualizado correctamente';

        DB::beginTransaction();
        try {
            $role->update($request->all());
            $role->permissions()->sync($request->permission);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            $status = 'error';
            $content = 'Se produjo un error al momento de la actualización del rol';
        }

        return redirect()
            ->route('admin.role.show', $role->id)
            ->with('process_result', [
                'status' => $status,
                'content' => $content
            ])
        ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()
            ->route('admin.role.index')
            ->with('process_result', [
                'status' => 'success',
                'content' => 'El rol fue eliminado satisfactoriamente'
            ]);
    }
}
