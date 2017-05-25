<?php

namespace Belt\Menu\Commands;

use Belt\Menu\Services\MenuService;
use Illuminate\Console\Command;

/**
 * Class PublishCommand
 * @package Belt\Menu\Commands
 */
class BuildCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'belt-menu:build {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    /**
     * @var MenuService
     */
    public $service;

    /**
     * @return MenuService
     */
    public function service()
    {
        return $this->service = $this->service ?: new MenuService();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');

        $this->service()->build($name);

    }

}