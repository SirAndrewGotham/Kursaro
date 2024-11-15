<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'language_create',
            ],
            [
                'id'    => 18,
                'title' => 'language_edit',
            ],
            [
                'id'    => 19,
                'title' => 'language_show',
            ],
            [
                'id'    => 20,
                'title' => 'language_delete',
            ],
            [
                'id'    => 21,
                'title' => 'language_access',
            ],
            [
                'id'    => 22,
                'title' => 'index_access',
            ],
            [
                'id'    => 23,
                'title' => 'system_access',
            ],
            [
                'id'    => 24,
                'title' => 'page_create',
            ],
            [
                'id'    => 25,
                'title' => 'page_edit',
            ],
            [
                'id'    => 26,
                'title' => 'page_show',
            ],
            [
                'id'    => 27,
                'title' => 'page_delete',
            ],
            [
                'id'    => 28,
                'title' => 'page_access',
            ],
            [
                'id'    => 29,
                'title' => 'home_create',
            ],
            [
                'id'    => 30,
                'title' => 'home_edit',
            ],
            [
                'id'    => 31,
                'title' => 'home_show',
            ],
            [
                'id'    => 32,
                'title' => 'home_delete',
            ],
            [
                'id'    => 33,
                'title' => 'home_access',
            ],
            [
                'id'    => 34,
                'title' => 'category_create',
            ],
            [
                'id'    => 35,
                'title' => 'category_edit',
            ],
            [
                'id'    => 36,
                'title' => 'category_show',
            ],
            [
                'id'    => 37,
                'title' => 'category_delete',
            ],
            [
                'id'    => 38,
                'title' => 'category_access',
            ],
            [
                'id'    => 39,
                'title' => 'group_access',
            ],
            [
                'id'    => 40,
                'title' => 'course_create',
            ],
            [
                'id'    => 41,
                'title' => 'course_edit',
            ],
            [
                'id'    => 42,
                'title' => 'course_show',
            ],
            [
                'id'    => 43,
                'title' => 'course_delete',
            ],
            [
                'id'    => 44,
                'title' => 'course_access',
            ],
            [
                'id'    => 45,
                'title' => 'promo_access',
            ],
            [
                'id'    => 46,
                'title' => 'banner_spot_create',
            ],
            [
                'id'    => 47,
                'title' => 'banner_spot_edit',
            ],
            [
                'id'    => 48,
                'title' => 'banner_spot_show',
            ],
            [
                'id'    => 49,
                'title' => 'banner_spot_delete',
            ],
            [
                'id'    => 50,
                'title' => 'banner_spot_access',
            ],
            [
                'id'    => 51,
                'title' => 'banner_type_create',
            ],
            [
                'id'    => 52,
                'title' => 'banner_type_edit',
            ],
            [
                'id'    => 53,
                'title' => 'banner_type_show',
            ],
            [
                'id'    => 54,
                'title' => 'banner_type_delete',
            ],
            [
                'id'    => 55,
                'title' => 'banner_type_access',
            ],
            [
                'id'    => 56,
                'title' => 'banner_create',
            ],
            [
                'id'    => 57,
                'title' => 'banner_edit',
            ],
            [
                'id'    => 58,
                'title' => 'banner_show',
            ],
            [
                'id'    => 59,
                'title' => 'banner_delete',
            ],
            [
                'id'    => 60,
                'title' => 'banner_access',
            ],
            [
                'id'    => 61,
                'title' => 'back_access',
            ],
            [
                'id'    => 62,
                'title' => 'feedback_create',
            ],
            [
                'id'    => 63,
                'title' => 'feedback_edit',
            ],
            [
                'id'    => 64,
                'title' => 'feedback_show',
            ],
            [
                'id'    => 65,
                'title' => 'feedback_delete',
            ],
            [
                'id'    => 66,
                'title' => 'feedback_access',
            ],
            [
                'id'    => 67,
                'title' => 'prospect_create',
            ],
            [
                'id'    => 68,
                'title' => 'prospect_edit',
            ],
            [
                'id'    => 69,
                'title' => 'prospect_show',
            ],
            [
                'id'    => 70,
                'title' => 'prospect_delete',
            ],
            [
                'id'    => 71,
                'title' => 'prospect_access',
            ],
            [
                'id'    => 72,
                'title' => 'contact_type_create',
            ],
            [
                'id'    => 73,
                'title' => 'contact_type_edit',
            ],
            [
                'id'    => 74,
                'title' => 'contact_type_show',
            ],
            [
                'id'    => 75,
                'title' => 'contact_type_delete',
            ],
            [
                'id'    => 76,
                'title' => 'contact_type_access',
            ],
            [
                'id'    => 77,
                'title' => 'contact_create',
            ],
            [
                'id'    => 78,
                'title' => 'contact_edit',
            ],
            [
                'id'    => 79,
                'title' => 'contact_show',
            ],
            [
                'id'    => 80,
                'title' => 'contact_delete',
            ],
            [
                'id'    => 81,
                'title' => 'contact_access',
            ],
            [
                'id'    => 82,
                'title' => 'course_feature_create',
            ],
            [
                'id'    => 83,
                'title' => 'course_feature_edit',
            ],
            [
                'id'    => 84,
                'title' => 'course_feature_show',
            ],
            [
                'id'    => 85,
                'title' => 'course_feature_delete',
            ],
            [
                'id'    => 86,
                'title' => 'course_feature_access',
            ],
            [
                'id'    => 87,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
