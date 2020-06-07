<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\VideoViewer;
use App\Models\Video;
class IncreaseCounter
{
    /**
     * Create the event listener.
     *
     * @return void
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
    public function handle(VideoViewer $event )
    {
        $this->updateView($event->video);
    }

    public function updateView($video)
    {
        // here we updated with Model 

        $video->viewers = $video->viewers + 1 ;

        $video->save();
    }

}
