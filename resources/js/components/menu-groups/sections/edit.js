// components
import shared from 'belt/content/js/components/sectionables/ctlr/shared';

// helpers
import Form from '../form';
import Table from '../table';

// templates
import edit_html from './edit.html';

export default {
    mixins: [shared],
    data() {
        return {
            table: new Table({query: {perMenuGroup: 5}}),
            menuGroup: new Form(),
        }
    },
    mounted() {
        if (this.section.sectionable_id) {
            this.menuGroup.show(this.section.sectionable_id);
        }
    },
    methods: {
        update(id)
        {
            let form = this.active;
            let menuGroup = this.menuGroup;
            let table = this.table;
            let self = this.self;

            form.sectionable_id = id;

            form.submit()
                .then(function () {
                    table.query.q = '';
                    table.items = [];
                    menuGroup.show(form.sectionable_id);
                });
        }
    },
    template: edit_html
}