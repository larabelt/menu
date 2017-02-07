<?php

namespace Ohio\Menu\Commands;

use Ohio\Core\Commands\PublishCommand as Command;

class PublishCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ohio-menu:publish {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'publish assets for ohio menu';

    protected $dirs = [
        'vendor/ohiocms/menu/config' => 'config/ohio',
        'vendor/ohiocms/menu/resources' => 'resources/ohio/menu',
    ];

}