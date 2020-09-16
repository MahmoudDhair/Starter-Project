<?php

namespace App\Listeners;

use App\Events\ViewViewer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncreaceViewer
{
    /**
     * Create the event listener.
     *
     * @param ViewViewer $event
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ViewViewer $event)
    {
        $this ->updateViewer($event -> video);
    }

    public function updateViewer($video){
        $video -> viewer = $video -> viewer + 1;
        $video -> save();
    }
}
