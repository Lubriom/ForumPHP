<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Contracts\Role;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function panel()
    {
        $users = User::paginate(8);

        return view('control.panel')->with('users', $users);
    }
    public function ranking()
    {
        $top = User::withCount(['post as total_likes' => function ($query) {
            $query->join('likes', 'posts.id', '=', 'likes.post_id');
        }])->orderByDesc('total_likes')->take(10)->get();

        return view('control.ranking')->with('top', $top);
    }

    public function edit($user)
    {
        $user = User::findOrFail($user);
        $roles = ['admin', 'editor', 'user'];
        return view('control.edit')->with('user', $user)->with('roles', $roles);
    }

    public function update(EditRequest $request, $user)
    {
        $request->validated();

        $user = User::findOrFail($user);

        $imgname = null;
        if ($request->hasFile('img_perfil')) {
            Storage::disk('users')->delete('profile/', $user->img_perfil);
            Storage::disk('users')->put('profile/', $request->file('img_perfil'));

            $imgname = $request->file('img_perfil')->hashName();
        } else {
            $user->img_perfil = $user->img_perfil;
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'img_perfil' => $imgname ? $imgname : $user->img_perfil
        ]);
  
        if (auth()->guard('web')->user()->roles[0]->name == 'admin') { 
            $user->syncRoles($request->rol);
        }


        return redirect('/control')->with('status', 'Usuario actualizado exitosamente');
    }

    public function destroy(Request $request, $user)
    {
        if (!$request->isMethod('delete')) {
            return redirect()->back();
        }
        if ($user == auth()->guard('web')->user()->id) { 
            return redirect('/control')->with('error', 'No puedes eliminar tu propia cuenta');
        }

        User::findOrFail($user)->delete();
        return redirect('/control')->with('status', 'Usuario eliminado exitosamente');
    }
}
