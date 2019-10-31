<?php
namespace App\Tool\Facades;

use App\Tool\ToolHeper;
use Illuminate\Support\Facades\Facade;

class Tool extends Facade {
    protected static function getFacadeAccessor() {
        return ToolHeper::class; // trả về 1 App\Tool\ToolHeper
    }
}
