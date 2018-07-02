<?php

namespace App\Console\Commands;
// require 'vendor\autoload.php';
use Illuminate\Console\Command;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\Storage;


class getUrls extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'url:get{url*}';
    protected $signature = 'url:get{url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enter a url and have it saved in the database for future refrencing in the compare command';

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
    //    $urls = $this->arguments('url*');
       $url = $this->argument('url');
       $file = uniqid('img_').date('m-d-Y_hia').'.png'; 
    //    $file = '/'.date('m-d-Y_hia').'.png';
    //    foreach($urls as $url){

        // Browsershot::url($url)->timeout(120)->fullPage()->save($file);
        $image = Browsershot::url($url)
        ->timeout(120)
        ->fullPage()
        ->screenshot();
        Storage::disk('s3')->put($file, $image);
        
       

    //    }
       
    }
}
