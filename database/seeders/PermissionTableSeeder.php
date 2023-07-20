<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
  
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
           'roles-list',
           'roles-create',
           'roles-edit',
           'roles-delete',
           'products-list',
           'products-create',
           'products-edit',
           'products-delete',
           'permission-list',
           'permission-create',
           'permission-edit',
           'permission-delete',
           'user-list',
           'user-create',
           'user-edit',
           'user-delete',
           'password-reset',
           'category-list',
           'category-create',
           'category-edit',
           'category-delete',
           'customer-list',
           'customer-create',
           'customer-edit',
           'customer-delete',
           'supplier-list',
           'supplier-create',
           'supplier-edit',
           'supplier-delete',
           'sale-list',
           'sale-create',
           'sale-edit',
           'sale-delete'

        ];
     
        foreach ($permissions as $permission) {
             Permission::create([
                'name' => $permission,
                 'description'=>'Permission created by a seeder',
                 'created_by'=>'Seeder'
            ]);
        }
    }
}