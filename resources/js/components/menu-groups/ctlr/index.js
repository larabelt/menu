// helpers
import Table from 'belt/menu/js/components/menu-groups/table';

// templates make a change
import heading_html from 'belt/core/js/templates/heading.html';
import index_html from 'belt/menu/js/components/menu-groups/templates/index.html';

export default {

    components: {
        heading: {template: heading_html},
        index: {
            data() {
                return {
                    table: new Table({router: this.$router}),
                }
            },
            mounted() {
                this.table.updateQueryFromRouter();
                this.table.index();
            },
            template: index_html,
        },
    },

    template: `
        <div>
            <heading>
                <span slot="title">Menu Group Manager</span>
            </heading>
            <section class="content">
                <index></index>
            </section>
        </div>
        `
}