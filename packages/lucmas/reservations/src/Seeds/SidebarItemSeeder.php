<?php

namespace Lucmas\Reservations\Seeds;

use Lucmas\Reservations\Model\SidebarItem;
use Illuminate\Database\Seeder;

class SidebarItemSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $order = SidebarItem::create([
            'parent_id' => NULL,
            'name' => 'orders',
            'route' => 'admin.order.index',
            'icon' => 'fal fa-desktop',
            'permission' => 'view-order'
        ]);

        $order = SidebarItem::create([
            'parent_id' => NULL,
            'name' => 'checkout',
            'route' => 'admin.checkout.index',
            'icon' => 'fal fa-desktop',
            'permission' => 'view-checkout'
        ]);

        $product = SidebarItem::create([
            'parent_id' => NULL,
            'name' => 'products',
            'route' => 'admin.product.index',
            'icon' => 'fal fa-desktop',
            'permission' => 'view-product'
        ]);

        $category = SidebarItem::create([
            'parent_id' => NULL,
            'name' => 'categories',
            'route' => 'admin.category.index',
            'icon' => 'fal fa-list-alt',
            'permission' => 'view-category'
        ]);

        $table = SidebarItem::create([
            'parent_id' => NULL,
            'name' => 'tables',
            'route' => 'admin.table.index',
            'icon' => 'fal fa-list-alt',
            'permission' => 'view-table'
        ]);

        $setting = SidebarItem::create([
            'parent_id' => NULL,
            'name' => 'settings',
            'route' => NULL,
            'icon' => 'fal fa-cogs',
            'permission' => NULL]);

        $userBase = SidebarItem::create([
            'parent_id' => NULL,
            'name' => 'user',
            'route' => NULL,
            'icon' => 'fal fa-users',
            'permission' => NULL
        ]);


        $users = SidebarItem::create([
            'parent_id' => $userBase->id,
            'name' => 'users',
            'route' => 'admin.user.index',
            'icon' => 'fal fa-users',
            'permission' => 'view-user'
        ]);

        $permission = SidebarItem::create([
            'parent_id' => $userBase->id,
            'name' => 'permissions',
            'route' => 'admin.permission.index',
            'icon' => 'fal fal fa-user-shield',
            'permission' => 'view-permission'
        ]);

        $role = SidebarItem::create([
            'parent_id' => $userBase->id,
            'name' => 'roles',
            'route' => 'admin.role.index',
            'icon' => 'fal fa-user-tag',
            'permission' => 'view-role'
        ]);
//
//        $api = SidebarItem::create([
//            'parent_id' => $setting->id,
//            'name' => 'api',
//            'route' => 'api.dashboard',
//            'icon' => 'fal fa-key',
//            'permission' => 'view-api-clients'
//        ]);
    }
}
