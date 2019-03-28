<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);

        // 头像假数据
        $avatars = [
            'https://i.loli.net/2019/03/26/5c9a2b16325a0.png',
            'https://i.loli.net/2019/03/26/5c9a2b266e359.png',
            'https://i.loli.net/2019/03/26/5c9a2b267c55e.png',
            'https://i.loli.net/2019/03/26/5c9a2b2698bcd.png',
            'https://i.loli.net/2019/03/26/5c9a2b269ddb5.png',
            'https://i.loli.net/2019/03/26/5c9a2b26a7f23.png',
        ];

        // 生成数据集合
        $users = factory(User::class)
                        ->times(10)
                        ->make()
                        ->each(function ($user, $index)
                            use ($faker, $avatars)
        {
            // 从头像数组中随机取出一个并赋值
            $user->avatar = $faker->randomElement($avatars);
        });

        // 让隐藏字段可见，并将数据集合转换为数组
        $user_array = $users->makeVisible(['password', 'remember_token'])->toArray();

        // 插入到数据库中
        User::insert($user_array);

        // 单独处理第一个用户的数据
        $user = User::find(1);
        $user->name = 'lof';
        $user->email = 'kyra10487@foxmail.com';
        $user->avatar = 'https://i.loli.net/2019/03/26/5c9a2b26a7f23.png';
        $user->save();


        // 初始化用户角色，将 1 号用户指派为『站长』
        $user->assignRole('Founder');

        // 将 2 号用户指派为『管理员』
        $user = User::find(2);
        $user->name = 'admin';
        $user->email = '719768607@qq.com';
        $user->avatar = 'https://i.loli.net/2019/03/26/5c9a2b26b01fb.png';
        $user->save();
        
        $user->assignRole('Maintainer');

    }
}