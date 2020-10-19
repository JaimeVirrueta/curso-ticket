<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Admin\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
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
    public function store(Request $request)
    {
        $request->validate([
            'first_name'    => 'required',
            'email'         => 'required|email|unique:users,email',
            'username'      => 'required|unique:users,username',
        ]);

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
            'row' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name'    => 'required',
            'email'         => 'required|email|unique:users,email,'.$user->id.',id',
            'username'      => 'required|unique:users,username,'.$user->id.',id',
        ]);

        $user->fill($request->all())->save();

        return redirect()->route('admin.user.show', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
