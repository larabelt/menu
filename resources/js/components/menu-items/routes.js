import index  from './ctlr/index';
import create  from './ctlr/create';
import edit  from './ctlr/edit';

export default [
    {path: '/menu-groups/edit/:menuGroupId/menu-items', component: index, name: 'menuItems'},
    {path: '/menu-groups/edit/:menuGroupId/menu-items/create', component: create, name: 'menuItems.create'},
    {path: '/menu-groups/edit/:menuGroupId/menu-items/edit/:menuItemId', component: edit, name: 'menuItems.edit'},
]