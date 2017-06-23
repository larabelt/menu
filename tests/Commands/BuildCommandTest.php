<?php

use Mockery as m;
use Belt\Core\Testing\BeltTestCase;
use Belt\Menu\Commands\BuildCommand;
use Belt\Menu\Services\MenuService;

class BuildCommandTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Menu\Commands\BuildCommand::service
     * @covers \Belt\Menu\Commands\BuildCommand::handle
     */
    public function testHandle()
    {
        # service
        $this->assertInstanceOf(MenuService::class, (new BuildCommand())->service());

        # handle
        $service = m::mock(MenuService::class);
        $service->shouldReceive('build')->once()->with('test')->andReturnSelf();
        $cmd = m::mock(BuildCommand::class . '[argument]');
        $cmd->service = $service;
        $cmd->shouldReceive('argument')->with('name')->andReturn('test');
        $cmd->handle();
    }

}