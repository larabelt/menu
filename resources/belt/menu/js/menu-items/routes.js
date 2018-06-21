import index  from 'belt/menu/js/menu-items/index';
import create  from 'belt/menu/js/menu-items/create';
import edit  from 'belt/menu/js/menu-items/edit';

export default [
    {path: '/menu-groups/edit/:menuGroupId/menu-items', component: index, name: 'menuItems'},
    {path: '/menu-groups/edit/:menuGroupId/menu-items/create', component: create, name: 'menuItems.create'},
    {path: '/menu-groups/edit/:menuGroupId/menu-items/edit/:menuItemId', component: edit, name: 'menuItems.edit'},
]