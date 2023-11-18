<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\User\UserServiceInterface;
use App\Ultilities\Common;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService=$userService;
    }

    public function index(Request $request)
    {
        $users = $this->userService->searchAndPaginate('name',$request->get('search'));
        return  view('admin.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->get('password') != $request->get('password_confirmation')){
            return back()
                ->with('notification','Mật khẩu xác nhận không đúng!!');
        }

        $data=$request->all();
        $data['password']=bcrypt($request->get('password'));

        if ($request->hasFile('image')){
            $data['avatar'] = Common::uploadFile($request->file('image'),'client/images/user');
        }

        $user = $this->userService->create($data);

        return redirect('admin/user/' . $user->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return  view('admin.user.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return  view('admin.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->all();

        if($request->get('password')!=null){
            if ($request->get('password')!=$request->get('password_confirmation')){
                return back()
                    ->with('notification','Mật khẩu xác nhận không đúng!!!');
            }

            $data['password']=bcrypt($request->get('password'));
        } else {
            unset($data['password']);
        }

        if($request->hasFile('image')){
            $data['avatar']=Common::uploadFile($request->file('image'),'client/images/user');

            $file_name_old = $request->get('image_old');
            if($file_name_old != ''){
                unlink('client/images/user/'.$file_name_old);
            }
        }


        $this->userService->update($data,$user->id);

        return redirect('admin/user/'.$user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->userService->delete($user->id);

        $file_name = $user->avatar;
            if($file_name != ''){
                unlink('client/images/user/'.$file_name);
            }
            return redirect('admin/user');
    }
}
