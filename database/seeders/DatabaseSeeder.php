<?php

namespace Database\Seeders;

use App\Models\Hilo;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Permission::create(['name' => 'admin.edit.rol']);
        Permission::create(['name' => 'admin.del.user']);
        Permission::create(['name' => 'admin.del.post']);
        Permission::create(['name' => 'ver.users']);
        Permission::create(['name' => 'edit.user']);
        Permission::create(['name' => 'user.add.post']);
        Permission::create(['name' => 'user.add.hilo']);

        // Crear roles y asignar permisos
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all()); // Asigna todos los permisos al rol admin

        $editorRole = Role::create(['name' => 'editor']);
        $editorRole->givePermissionTo(['ver.users', 'edit.user', 'user.add.post', 'user.add.hilo']);

        $usuarioRole = Role::create(['name' => 'user']);
        $usuarioRole->givePermissionTo(['user.add.post', 'user.add.hilo']);

        User::factory()->count(50)->create();
        Hilo::factory()->count(10)->create();
        Post::factory()->count(100)->create();
        Like::factory()->count(300)->create();
    }
}
