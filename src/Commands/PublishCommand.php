<?php

namespace Belt\Menu\Commands;

use Belt\Core\Commands\PublishCommand as Command;

class PublishCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'belt-menu:publish {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'publish assets for belt menu';

    protected $dirs = [
        'vendor/larabelt/menu/config' => 'config/belt',
        //'vendor/larabelt/menu/resources' => 'resources/belt/menu',
    ];

}