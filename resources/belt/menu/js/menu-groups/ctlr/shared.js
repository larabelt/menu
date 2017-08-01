// helpers
import MenuGroupForm from 'belt/menu/js/menu-groups/form';

// templates make a change
import heading_html from 'belt/core/js/templates/heading.html';
import tabs_html from 'belt/menu/js/menu-groups/templates/tabs.html';
import edit_html from 'belt/menu/js/menu-groups/templates/edit.html';

export default {
    data() {
        return {
            menuGroup: new MenuGroupForm(),
            menuGroupId: this.$route.params.menuGroupId,
        }
    },
    mounted() {
        this.menuGroup.show(this.menuGroupId);
    },
    components: {
        heading: {template: heading_html},
        tabs: {template: tabs_html},
    },
    template: edit_html,
}