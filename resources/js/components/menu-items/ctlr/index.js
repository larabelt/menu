import MenuItemForm from '../form';
import Table from '../table';
import TreeForm from '../tree';
import index_html from '../templates/index.html';
import shared from 'belt/menu/js/components/menu-groups/ctlr/shared';

export default {
    mixins: [shared],
    components: {
        tab: {
            data() {
                return {
                    loading: false,
                    moving: new MenuItemForm({menuGroupId: this.$parent.menuGroupId}),
                    table: new Table({router: this.$router, menuGroupId: this.$route.params.menuGroupId}),
                }
            },
            computed: {
                isMoving() {
                    return this.moving.id;
                },
            },
            methods: {
                cancelMove() {
                    this.moving.reset();
                },
                move(id, position) {
                    return new Promise((resolve, reject) => {

                        let tree = new TreeForm({menuItem: this.moving});

                        tree.setData({
                            neighbor_id: id,
                            move: position,
                        });

                        tree.submit()
                            .then(() => {
                                this.moving.reset();
                                this.table.index();
                                resolve();
                            })
                            .catch(() => {
                                reject();
                            });
                    });
                },
                setMoving(id) {
                    if (!this.moving.id) {
                        this.moving.show(id);
                    } else {
                        this.moving.reset();
                    }
                },
            },
            mounted() {
                this.table.updateQueryFromRouter();
                this.loading = true;
                this.table.index()
                    .then(() => {
                        this.loading = false;
                    });
            },
            template: index_html,
        },
    },
}