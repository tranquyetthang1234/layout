<?php

namespace App\Listeners;

use App\Events\ViewProducts;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CountViewPordcuts implements ShouldQueue
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
     * @param  ViewProducts  $event
     * @return void
     */
    public function handle(ViewProducts $event)
    {
        $id = $event->article->id;
        $flag = 0 ;
        if(\Session::exists('view'))
        {
            $view = \Session::get('view');
            if(array_key_exists($id, $view['product']))
                {
                    $time = time();
                    $view = \Session::get('view');
                    $viewproduct = $view['product'][$id];
                        if(($viewproduct['time']+ $this->times) > $time === false ){
                            $flag = 1;
                            $view['product'][$id] = ['time'=>time()];
                            \Session::put('view',$view);
                        }
                 }else{
                     $view['product'][$id] = ['time'=>time()];
                     \Session::put('view',$view);
                     $flag = 1;
                 }

        }else{
            $view['product'][$id] = ['time'=>time()];
            \Session::put('view',$view);
             $flag = 1;
        }


        if($flag ==1){
            $event->article->view +=1;
            $event->article->save();
            return true;
        }

    }
}
