<?php

namespace Modules\ShopifySync\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;
use App\Models\Role;
use App\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $permission  = [
            'shopify manage',
            'shopify customer manage',
            'shopify product manage',
            'shopify order manage',
            'shopify order show',
            'shopify category manage',
            'shopify coupon manage',
        ];

        $company_role = Role::where('name','company')->first();

        foreach ($permission as $key => $value)
        {
            $table = Permission::where('name',$value)->where('module','ShopifySync')->exists();
            if(!$table)
            {
                $data = Permission::create(
                    [
                        'name' => $value,
                        'guard_name' => 'web',
                        'module' => 'ShopifySync',
                        'created_by' => 0,
                        "created_at" => date('Y-m-d H:i:s'),
                        "updated_at" => date('Y-m-d H:i:s')
                    ]
                );
            
                if(!$company_role->hasPermission($value)){
                    $company_role->givePermission($data);
                }
            }
        }
        
    }

}
