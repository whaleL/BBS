<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;
use Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    public function show(User $user)
    {   
        $topic = $user->topics()
                           ->orderBy('created_at', 'desc')
                           ->paginate(30);
        
        return view('users.show', compact('user'));
    }

    public function home(User $user)//用户的空间
    {
        $topics = $user->topics()
                           ->orderBy('created_at', 'desc')
                           ->paginate(30);
        //$title = $topics->title;
        return view('users.home', compact('user','topics'));
    }

    public function edit(User $user) //edit用户接受$user 用户作为传参
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    //关注列表和粉丝列表

    public function followings(User $user)
    {
        $users = $user->followings()->paginate(30);
        $title = $user->name . '关注的人';
        return view('users.show_follow', compact('users', 'title'));
    }

    public function followers(User $user)
    {
        $users = $user->followers()->paginate(30);
        $title = $user->name . '的粉丝';
        return view('users.show_follow', compact('users', 'title'));
    }
    

    public function update(UserRequest $request, ImageUploadHandler $uploader, User $user)
    {
        $this->authorize('update', $user);
       $data = $request->all();

       if ($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatars', $user->id, 416);
            if ($result) {
               $data['avatar'] = $result['path'];
          }
       }
       //dd($request->avatar);测试上传头像功能
        $user->update($data);
        return redirect()->route('users.show', $user->id)->with('success', '更新成功！');
    }

    
}
