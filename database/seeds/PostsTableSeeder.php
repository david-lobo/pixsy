<?php

use Illuminate\Database\Seeder;
use App\Models\Media;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $medias = Media::where('collection_name', 'gallery')->get();

        if (!empty($medias)) {
            foreach ($medias as $media) {
                $media->delete();
            }
        }

        DB::table('posts')->delete();

        $dimensions = [
            [
                'width' => '800',
                'height' => '600',
            ],
            [
                'width' => '1200',
                'height' => '800',
            ],
            [
                'width' => '1000',
                'height' => '500',
            ],
            [
                'width' => '1000',
                'height' => '562',
            ],
        ];

        $imageData = [];

        $id = 1084;

        for($i = 0; $i < 24; $i++) {
            shuffle($dimensions);
            //dd($rand_keys);
            $dimension = $dimensions[0];
            $image = [
                'id' => $id,
                'collection' => 'gallery',
                'width' => $dimension['width'],
                'height' => $dimension['height']
            ];
            $imageData[] = $image;
            $id--;
        }

        $user = User::where('email', '=', 'david@davidlobo.co.uk')->firstOrFail();
        $baseUrl = 'https://picsum.photos';
        $faker = Faker\Factory::create();

        foreach ($imageData as $image) {
            $title = $faker->sentence($nbWords = 6, $variableNbWords = true);
            $description = $faker->sentence($nbWords = 3, $variableNbWords = true);

            $post = new Post;
            $post->title = $title;
            $post->description = $description;
            $post->user_id = $user->id;
            $post->save();

            $filename = Str::random(8) . '.jpg';
            $url = $baseUrl . "/{$image['width']}/{$image['height']}?image={$image['id']}";

            $media = $post->addMediaFromUrl($url)->usingName($filename)->usingFileName($filename)->toMediaCollection($image['collection']);

            $media->save();
        }
    }
}
