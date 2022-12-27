<?php
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    public function run()
    {
        $admins = [
            [
                'id' => 1,
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin@123#'),
                'name' => 'admin',
                'created_at' => Carbon\Carbon::now()
            ]
        ];

        foreach ($admins as $user) {
            \App\Admin::create($user);
        }
        \App\Models\GlobalSetting::create(
            [
                'id' => 1,
                'site_name' => 'Rapti Fashion Direct',
                'site_nepali_name' => '',
                'site_email' => 'info@raptifashion.com.np',
                'phone' => '977 4257848, 4251144',
                'website_full_address' => 'Baba Complex, Tripureshwor, Kathmandu, Nepal',
                'page_title' => '',
                'page_keyword' => '',
                'page_description' => '',
                'favicon' => '',
                'site_logo' => '',
                'site_logo_nepali' => '',
                'site_status' => 1,
                'extra_one' => '',
                'extra_two' => ''
            ]);


    }
}
