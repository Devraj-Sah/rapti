<?php
use Illuminate\Database\Seeder;

class PageTypeTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'sort' => 1,
                'page_type_title' => 'Normal',
                'created_at' => Carbon\Carbon::now()
            ],
            [
                'sort' => 2,
                'page_type_title' => 'Group',
                'created_at' => Carbon\Carbon::now()
            ],
            [
                'sort' => 3,
                'page_type_title' => 'Photo Gallery',
                'created_at' => Carbon\Carbon::now()
            ],
            [
                'sort' => 4,
                'page_type_title' => 'Video Gallery',
                'created_at' => Carbon\Carbon::now()
            ],
            [
                'sort' => 5,
                'page_type_title' => 'Link',
                'created_at' => Carbon\Carbon::now()
            ],
            [
                'sort' => 6,
                'page_type_title' => 'Slider',
                'created_at' => Carbon\Carbon::now()
            ],
            [
                'sort' => 7,
                'page_type_title' => 'Attachment',
                'created_at' => Carbon\Carbon::now()
            ],
            [
                'sort' => 8,
                'page_type_title' => 'Audio Gallery',
                'created_at' => Carbon\Carbon::now()
            ]

        ];

        foreach ($users as $user) {
            \App\Models\PageType::create($user);
        }

    }
}
