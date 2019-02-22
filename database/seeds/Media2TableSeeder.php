<?php

use Illuminate\Database\Seeder;
use App\Models\Media ;
use App\User;
use Illuminate\Support\Str;

class MediaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('media')->delete();
        $medias = Media::all();
        foreach ($medias as $media) {
            //$media->clearMediaCollection();
            //var_dump($media->id);
            $media->delete();
        }

        //4:3, 3:2, 16:9
        //
        $imageData = [
            [
                'name' => 'Jay Ruzesky',
                'id' => '1084',
                'width' => '800',
                'height' => '600',
                'collection' => 'gallery'
            ],
            [
                'name' => 'Sweet Ice Cream Photography',
                'id' => '1083',
                'width' => '1200',
                'height' => '800',
                'collection' => 'gallery'
            ],
                        [
                'name' => 'Lukas Budimaier',
                'id' => '1082',
                'width' => '1000',
                'height' => '500',
                'collection' => 'gallery'
            ],
            [
                'name' => 'Julien Moreau',
                'id' => '1081',
                'width' => '800',
                'height' => '600',
                'collection' => 'gallery'
            ],
            [
                'name' => 'veeterzy',
                'id' => '1080',
                'width' => '1000',
                'height' => '562',
                'collection' => 'gallery'
            ],
            [
                'name' => 'Kamesh Vedula',
                'id' => '1079',
                'width' => '800',
                'height' => '600',
                'collection' => 'gallery'
            ]

        ];

        $user = User::where('email', '=', 'david@davidlobo.co.uk')->firstOrFail();
        //$url = 'https://picsum.photos/800/600?image=1084';
        $baseUrl = 'https://picsum.photos';

        $count = 0;
        $faker = Faker\Factory::create();

        foreach ($imageData as $image) {
            if ($count > 0) {
                //continue;
            }
            $description = $faker->sentence($nbWords = 6, $variableNbWords = true);

            $filename = Str::random(8) . '.jpg';
            $url = $baseUrl . "/{$image['width']}/{$image['height']}?image={$image['id']}";

            $media = $user->addMediaFromUrl($url)->usingName($image['name'])->usingFileName($filename)->toMediaCollection($image['collection']);
            $count++;

            $media->description = $description;
            $media->save();
        }

    }
}
