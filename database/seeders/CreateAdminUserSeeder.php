<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;
  
class CreateAdminUserSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'Admin']);
        $user = User::create([ 
            'name'=>'Alva',
            'email' => 'alva@gmail.com',
            'phone_number'=>'0788777788',
            'password' => '12345678',
            'role'=>$role->name,
        ]);
    
        
     
        $permissions = Permission::pluck('id','id')->all();
   
        $role->syncPermissions($permissions);
     
        $user->assignRole([$role->id]);
    
    }
}