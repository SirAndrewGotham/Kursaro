<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission' => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                           => 'ID',
            'id_helper'                    => ' ',
            'name'                         => 'Name',
            'name_helper'                  => ' ',
            'email'                        => 'Email',
            'email_helper'                 => ' ',
            'email_verified_at'            => 'Email verified at',
            'email_verified_at_helper'     => ' ',
            'password'                     => 'Password',
            'password_helper'              => ' ',
            'roles'                        => 'Roles',
            'roles_helper'                 => ' ',
            'remember_token'               => 'Remember Token',
            'remember_token_helper'        => ' ',
            'created_at'                   => 'Created at',
            'created_at_helper'            => ' ',
            'updated_at'                   => 'Updated at',
            'updated_at_helper'            => ' ',
            'deleted_at'                   => 'Deleted at',
            'deleted_at_helper'            => ' ',
            'two_factor'                   => 'Two-Factor Auth',
            'two_factor_helper'            => ' ',
            'two_factor_code'              => 'Two-factor code',
            'two_factor_code_helper'       => ' ',
            'two_factor_expires_at'        => 'Two-factor expires at',
            'two_factor_expires_at_helper' => ' ',
            'language'                     => 'Language',
            'language_helper'              => ' ',
        ],
    ],
    'language' => [
        'title'          => 'Languages',
        'title_singular' => 'Language',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'default'           => 'Default',
            'default_helper'    => 'Is it default?',
            'fallback'          => 'Fallback',
            'fallback_helper'   => 'Is it fallback locale?',
            'code'              => 'Code',
            'code_helper'       => 'Language code',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'regional'          => 'Regional',
            'regional_helper'   => ' ',
            'script'            => 'Script',
            'script_helper'     => ' ',
            'dir'               => 'Dir',
            'dir_helper'        => ' ',
            'flag'              => 'Flag',
            'flag_helper'       => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'english'           => 'English',
            'english_helper'    => ' ',
            'slug'              => 'Slug',
            'slug_helper'       => ' ',
            'available'         => 'Available',
            'available_helper'  => ' ',
            'active'            => 'Active',
            'active_helper'     => ' ',
        ],
    ],
    'index' => [
        'title'          => 'Index',
        'title_singular' => 'Index',
    ],
    'system' => [
        'title'          => 'System',
        'title_singular' => 'System',
    ],
    'page' => [
        'title'          => 'Pages',
        'title_singular' => 'Page',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'is_default'        => 'Default',
            'is_default_helper' => ' ',
            'is_active'         => 'Enabled',
            'is_active_helper'  => ' ',
            'language'          => 'Language',
            'language_helper'   => ' ',
            'translation'       => 'Translation',
            'translation_helper'=> ' ',
            'translations'      => 'Translations',
            'translations_helper'=> ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'slug'              => 'Slug',
            'slug_helper'       => ' ',
            'content'           => 'Content',
            'content_helper'    => ' ',
            'views'             => 'Views',
            'views_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'page'              => 'Page',
            'page_helper'       => ' ',
        ],
    ],
    'home' => [
        'title'          => 'Home',
        'title_singular' => 'Home',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'language'          => 'Language',
            'language_helper'   => ' ',
            'is_active'         => 'Enabled',
            'is_active_helper'  => 'Is this homepage version enabled?',
            'is_default'        => 'Default',
            'is_default_helper' => 'Is it your default homepage?',
            'translation'       => 'Translation',
            'translation_helper'=> '',
            'translate'         => 'Translate',
            'translate_helper'  => '',
            'title'             => 'Title',
            'title_helper'      => 'Optional title for the home page',
            'content'           => 'Content',
            'content_helper'    => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'category' => [
        'title'          => 'Categories',
        'title_singular' => 'Category',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Name',
            'name_helper'        => 'Category name',
            'slug'               => 'Slug',
            'slug_helper'        => ' ',
            'description'        => 'Description',
            'description_helper' => 'Optional category description',
            'image'              => 'Image',
            'image_helper'       => 'Optional category cover',
            'language'           => 'Language',
            'language_helper'    => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'category'           => 'Category',
            'category_helper'    => ' ',
        ],
    ],
    'group' => [
        'title'          => 'Groups',
        'title_singular' => 'Group',
    ],
    'course' => [
        'title'          => 'Courses',
        'title_singular' => 'Course',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'user'                  => 'User',
            'user_helper'           => ' ',
            'language'              => 'Language',
            'language_helper'       => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
            'name'                  => 'Name',
            'name_helper'           => ' ',
            'slug'                  => 'Slug',
            'slug_helper'           => ' ',
            'course'                => 'Course',
            'course_helper'         => ' ',
            'image'                 => 'Image',
            'image_helper'          => 'Optional course cover',
            'description'           => 'Description',
            'description_helper'    => ' ',
            'link'                  => 'Link',
            'link_helper'           => ' ',
            'is_active'             => 'Is Active',
            'is_active_helper'      => ' ',
            'all_languages'         => 'All Languages',
            'all_languages_helper'  => ' ',
            'views'                 => 'Views',
            'views_helper'          => ' ',
            'category'              => 'Category',
            'category_helper'       => ' ',
            'course_feature'        => 'Course Feature',
            'course_feature_helper' => ' ',
        ],
    ],
    'promo' => [
        'title'          => 'Promo',
        'title_singular' => 'Promo',
    ],
    'bannerSpot' => [
        'title'          => 'Banner Spots',
        'title_singular' => 'Banner Spot',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Name',
            'name_helper'        => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'size'               => 'Size',
            'size_helper'        => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'bannerType' => [
        'title'          => 'Banner Types',
        'title_singular' => 'Banner Type',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Name',
            'name_helper'        => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'is_active'          => 'Is Active',
            'is_active_helper'   => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'banner' => [
        'title'          => 'Banners',
        'title_singular' => 'Banner',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'banner_type'          => 'Banner Type',
            'banner_type_helper'   => ' ',
            'banner_spot'          => 'Banner Spot',
            'banner_spot_helper'   => ' ',
            'all_languages'        => 'All Languages',
            'all_languages_helper' => ' ',
            'language'             => 'Languages',
            'language_helper'      => ' ',
            'is_active'            => 'Is Active',
            'is_active_helper'     => ' ',
            'title'                => 'Title',
            'title_helper'         => ' ',
            'subtitle'             => 'Subtitle',
            'subtitle_helper'      => ' ',
            'teaser'               => 'Teaser',
            'teaser_helper'        => ' ',
            'path'                 => 'Path',
            'path_helper'          => ' ',
            'image'                => 'Image',
            'image_helper'         => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
        ],
    ],
    'back' => [
        'title'          => 'Back',
        'title_singular' => 'Back',
    ],
    'feedback' => [
        'title'          => 'Feedback',
        'title_singular' => 'Feedback',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'user'              => 'User',
            'user_helper'       => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'email'             => 'Email',
            'email_helper'      => ' ',
            'message'           => 'Message',
            'message_helper'    => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'prospect' => [
        'title'          => 'Prospects',
        'title_singular' => 'Prospect',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'course'               => 'Course',
            'course_helper'        => ' ',
            'user'                 => 'User',
            'user_helper'          => ' ',
            'language'             => 'Language',
            'language_helper'      => ' ',
            'name'                 => 'Name',
            'name_helper'          => ' ',
            'slug'                 => 'Slug',
            'slug_helper'          => ' ',
            'image'                => 'Image',
            'image_helper'         => 'Optional course cover',
            'description'          => 'Description',
            'description_helper'   => ' ',
            'link'                 => 'Link',
            'link_helper'          => ' ',
            'is_active'            => 'Is Active',
            'is_active_helper'     => ' ',
            'all_languages'        => 'All Languages',
            'all_languages_helper' => ' ',
            'views'                => 'Views',
            'views_helper'         => ' ',
            'category'             => 'Category',
            'category_helper'      => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
        ],
    ],
    'contactType' => [
        'title'          => 'Contact Types',
        'title_singular' => 'Contact Type',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Name',
            'name_helper'        => ' ',
            'slug'               => 'Slug',
            'slug_helper'        => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'contact' => [
        'title'          => 'Contacts',
        'title_singular' => 'Contact',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'contact_type'         => 'Contact Type',
            'contact_type_helper'  => ' ',
            'contact'              => 'Contact',
            'contact_helper'       => ' ',
            'is_public'            => 'Is Public',
            'is_public_helper'     => ' ',
            'is_preferable'        => 'Is Preferable',
            'is_preferable_helper' => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
        ],
    ],
    'courseFeature' => [
        'title'          => 'Course Features',
        'title_singular' => 'Course Feature',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Name',
            'name_helper'        => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'feature'            => 'Feature',
            'feature_helper'     => ' ',
        ],
    ],

];
