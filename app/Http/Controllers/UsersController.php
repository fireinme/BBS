<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use App\Handlers\ImageUploadHandler;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user, ImageUploadHandler $uploader)
    {
        $this->authorize('update', $user);

        $file = $request->avatar;
        $data = $request->all();
        if (!empty($file)) {
            $result = $uploader->save($file, 'avatars', $user->id);
            if ($result) {
                $path = $result['path'];
                $data['avatar'] = $path;
            }
        }

        $user->update($data);
        return redirect()->route('users.show', $user)->with('success', '个人资料更新成功！');
    }
}
