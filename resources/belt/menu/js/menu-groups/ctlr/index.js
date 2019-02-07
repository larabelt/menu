// helpers
import Table from 'belt/menu/js/menu-groups/table';

// templates make a change

import index_html from 'belt/menu/js/menu-groups/templates/index.html';

export default {

    components: {

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
                <span slot="help"><link-help docKey="admin.menu.menu_groups.manager" /></span>
                <li><router-link :to="{ name: 'menuGroups' }">Menu Group Manager</router-link></li>
            </heading>
            <section class="content">
                <index></index>
            </section>
        </div>
        `
}