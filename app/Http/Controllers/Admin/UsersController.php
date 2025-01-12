<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    public function index()
    {
//        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $users = User::with(['roles'])->get();
        $roles = Role::pluck('title', 'id');
        return view('admin.doctor.index', compact('users', 'roles'));
    }


    public function store(StoreUserRequest $request)
    {
//        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));

        toastr()->success(trans('global.create_success'), ['timeOut' => 20000, 'closeButton' => true]);
        return response()->json(['status' => true, 'msg' => trans('global.create_success')]);
    }

    public function edit(User $user)
    {
//        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $roles = Role::pluck('title', 'id');
        $user->load('roles');
        return view('admin.doctor.edit', compact('roles', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));

        return response()->json(['status' => true, 'msg' => trans('global.update_success')]);
    }

    public function show(User $user)
    {
//        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user->load('roles');

        return view('admin.doctor.show', compact('user'));
    }

    public function destroy(User $user)
    {
//        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user->delete();
        return response()->json(['status' => true, 'msg' => trans('global.update_success')]);
    }


    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();
        return response()->json(['status' => true, 'msg' => trans('global.delete_success')]);
    }

    public function changePassword()
    {
        return view('admin.users.changePassword');
    }

    public function hospitalChangePassword()
    {
        return view('admin.users.hospitalChangePassword');
    }
    public function labChangePassword()
    {
        return view('admin.users.labChangePassword');
    }

    public function saveChangePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
        ], [

            'password.required' => __('cruds.user.password_required'),
            'password_confirmation.required' => __('cruds.user.password_confirmation_required'),
            'password.confirmed' => __('cruds.user.password_confirmation_equalTo'),
            'password.min' => __('cruds.user.password_minlength'),
        ]);

        $user = User::find(auth()->user()->id);

        $user->update([
            'password' => bcrypt($request->password)
        ]);

        return response()->json([
            'status' => true,
            'message' => __('cruds.user.Password_updated_successfully'),
        ]);
    }

}
