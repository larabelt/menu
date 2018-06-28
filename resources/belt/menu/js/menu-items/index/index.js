import shared from 'belt/menu/js/menu-groups/ctlr/shared';
import Form from 'belt/menu/js/menu-items/helpers/form';
import Table from 'belt/menu/js/menu-items/helpers/table';
import TreeForm from 'belt/menu/js/menu-items/helpers/tree';
import html from 'belt/menu/js/menu-items/index/template.html';

export default {
    mixins: [shared],
    components: {
        tab: {
            data() {
                return {
                    loading: false,
                    moving: new Form({menuGroupId: this.$parent.menuGroupId}),
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
            template: html,
        },
    },
}