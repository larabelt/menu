<?php

namespace Belt\Menu\Commands;

use Belt\Core\Commands\PublishCommand as Command;

/**
 * Class PublishCommand
 * @package Belt\Menu\Commands
 */
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

    /**
     * @var array
     */
    protected $dirs = [
        'vendor/larabelt/menu/config' => 'config/belt',
        'vendor/larabelt/menu/resources/js' => 'resources/belt/menu/js',
        'vendor/larabelt/menu/resources/menus' => 'resources/belt/menu/menus',
        'vendor/larabelt/menu/resources/sass' => 'resources/belt/menu/sass',
    ];

}