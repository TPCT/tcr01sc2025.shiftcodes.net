<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class SetupPermissions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $all_permission = config('all-permission');
        foreach ($all_permission as $permission) {
            $pr = Permission::where('name', $permission['permission'])->first();
            if(!$pr) {
                Permission::create(['name' => $permission['permission']]);
            }
            $admins = \App\Models\User::where('type', 'admin')->get();
            foreach ($admins as $user) {
                $user->givePermissionTo($permission['permission']);
            }
            $users = \App\Models\User::where('type', 'user')->get();
            foreach ($users as $user) {
                $user->givePermissionTo("home");
                $user->givePermissionTo("cars");
            }
        }
    }
}
