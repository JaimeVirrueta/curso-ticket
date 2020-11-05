<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    const PERMISSIONS = [
        'show' => 'admin-permission-show',
    ];

    public function __construct()
    {
        $this->middleware('permission:'.self::PERMISSIONS['show']);
    }

    public function index()
    {
        $permissions = Permission::orderBy('name')->paginate();

        return view('admin.permission.index', [
            'rows' => $permissions,
        ]);
    }

    public function show(Permission $permission)
    {
        return view('admin.permission.show', [
            'row' => $permission
        ]);
    }
}
