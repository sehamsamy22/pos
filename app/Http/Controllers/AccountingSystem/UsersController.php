<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Area;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();

        return view('admin.users.index',compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas=Area::pluck('name','id')->toArray();
        $roles = Role::pluck('name','id')->toArray();
        return view('admin.users.create',compact('areas','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {

        $requests = $request->except('image');
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'photos');
        }
       $user= User::create($requests);
        $user->assignRole(Role::find($request->input('role_id')));
        $user->syncPermissions(Role::find($request->input('role_id'))->permissions()->pluck('id'));
        return back()->with('success', 'تم اضافه المستخدم');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $areas=Area::pluck('name','id')->toArray();
        $userRole = $user->roles->pluck('name','id')->all();
        $roles = Role::pluck('name','id')->toArray();
        return view('admin.users.edit', compact('user','areas','roles','userRole'));
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
            'name' => 'required|string|max:191',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|min:6|',
            'phone' => 'nullable|unique:users,phone,'.$user->id
        ]);

        if ($request->has('old_password') && !empty($request->old_password)) {
            if (!\Hash::check($request->old_password, $user->password)) {
                return back()->with('fail', 'الباسورد خطأ');
            }
        }
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'photos');
        }
        $user->update($request->all());
        DB::table('model_has_roles')->where('model_id',$user->id)->delete();
        DB::table('model_has_permissions')->where('model_id',$user->id)->delete();

        $user->assignRole(Role::find($request->input('role_id')));
        $user->syncPermissions(Role::find($request->input('role_id'))->permissions()->pluck('id'));

        return redirect()->route('dashboard.users.index')->with('success', __('تم التعديل'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id )
    {
        User::find($id)->delete();
        return redirect()->route('dashboard.users.index')->with('success', __('تم المسح بنجاح'));
    }
}
