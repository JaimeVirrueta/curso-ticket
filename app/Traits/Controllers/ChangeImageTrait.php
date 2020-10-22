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

        $status = 'success';
        $content = 'La imagen ha sido correctamente cargada';

        DB::beginTransaction();
        try {
            $user->image_path = $image_name;
            $request->image->storeAs('image_profiles', $image_name);
            $user->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            $status = 'error';
            $content = 'Se produjo un error al momento de la carga de la imagen';
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
