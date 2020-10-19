<?php

namespace App\Traits\Controllers;

use App\Entities\Admin\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

trait ChangeImageTrait
{

    public function image(Request $request, User $user)
    {
        $image_name = $user->id.'.'.$request->image->getClientOriginalExtension();

        DB::beginTransaction();
        try {
            $user->image_path = $image_name;
            $request->image->storeAs('image_profiles', $image_name);
            $user->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }

        return redirect()->route('admin.user.show', $user->id);
    }
}
