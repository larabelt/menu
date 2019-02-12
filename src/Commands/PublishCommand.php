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
    protected $signature = 'belt-menu:publish {action=publish} {--include=} {--exclude=} {--force} {--config} {--prune}';

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
        'vendor/larabelt/menu/resources/menus' => 'resources/belt/menu/menus',
        'vendor/larabelt/menu/database/factories' => 'database/factories',
        'vendor/larabelt/menu/database/migrations' => 'database/migrations',
        'vendor/larabelt/menu/database/seeds' => 'database/seeds',
        'vendor/larabelt/menu/docs' => 'resources/docs/raw',
    ];

}