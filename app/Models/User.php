<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Spatie\Permission\Traits\HasRoles;//laravel-permission trait hasroles 权限


use Auth;


class User extends Authenticatable implements MustVerifyEmailContract
    {
    use HasRoles;
    use MustVerifyEmailTrait;

     use Notifiable {
        notify as protected laravelNotify;
    }

    public function notify($instance)
    {
        // 如果要通知的人是当前用户，就不必通知了！
        if ($this->id == Auth::id()) {
            return;
        }

        // 只有数据库类型通知才需提醒，直接发送 Email 或者其他的都 Pass
        if (method_exists($instance, 'toDatabase')) {
            $this->increment('notification_count');
        }

        $this->laravelNotify($instance);
    }

    protected $fillable = [
        'name', 'email', 'password','introduction','avatar',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }//用户模型和话题模型的关联 用户与话题是一对多的关系，用hasMant（）方法关联

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }//添加回复帖子





    public function isAuthorOf($model)
    {
        return $this->id == $model->user_id;
    }//删除回复用



    public function markAsRead()
    {
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }
}