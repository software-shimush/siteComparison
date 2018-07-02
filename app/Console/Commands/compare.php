<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \Imagick;
use Illuminate\Support\Facades\Storage;

class compare extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'compare:difference';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to compare to images using php imagick library';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // $contents = Storage::disk('s3')->download('img_5b3a5cb73974c07-02-2018_0511pm.png');
        // $url = Storage::disk('s3')->url('img_5b3a5cb73974c07-02-2018_0511pm.png');
        $url = Storage::disk('s3')->temporaryUrl(
            'img_5b3a5cb73974c07-02-2018_0511pm.png', now()->addMinutes(5)
        );
        $image = file_get_contents($url);

        $image1 = new imagick();
        $image1 -> readImageBlob($image);
        $image2 = new imagick();
        $image2 -> readImageBlob($image);

        $result = $image1->compareImages($image2, Imagick::METRIC_MEANSQUAREERROR);
        $result[0]->setImageFormat("png");

        header("Content-Type: image/png");
        echo $result[0];
    }
}
