// helpers
import MenuGroupForm from '../form';

// templates make a change
import heading_html from 'belt/core/js/templates/heading.html';
import tabs_html from '../templates/tabs.html';
import edit_html from '../templates/edit.html';

export default {
    data() {
        return {
            menuGroup: new MenuGroupForm(),
            menuGroupId: this.$route.params.menuGroupId,
        }
    },
    components: {
        heading: {template: heading_html},
        tabs: {template: tabs_html},
    },
    mounted() {
        this.menuGroup.show(this.menuGroupId);
    },
    template: edit_html,
}