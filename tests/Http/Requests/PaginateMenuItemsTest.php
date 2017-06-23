<?php

use Mockery as m;
use Belt\Core\Testing;
use Belt\Menu\Http\Requests\PaginateMenuItems;
use Illuminate\Database\Eloquent\Builder;

class PaginateMenuItemsTest extends Testing\BeltTestCase
{

    use Testing\CommonMocks;

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Menu\Http\Requests\PaginateMenuItems::modifyQuery
     */
    public function test()
    {
        # modifyQuery
        $query = m::mock(Builder::class);
        $query->shouldReceive('where')->once()->with('menu_group_id', 1)->andReturnSelf();
        $query->shouldReceive('withDepth')->once()->andReturnSelf();

        $request = new PaginateMenuItems(['menu_group_id' => 1]);
        $request->modifyQuery($query);
    }

}