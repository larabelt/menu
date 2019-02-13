<section>
    <div class="row">
        <div class="col-lg-12">
            <div id="belt-app-pre-main">
                <div id="belt-work-requests-alerts"><!----></div>
            </div>

            <div id="belt-menu">
                <div>
                    <div>
                        <section class="content-header">
                            <ol class="breadcrumb">
                                <li><a href="/admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                                <li><a href="/admin/belt/menu/menu-groups" class="router-link-active">Menu Group Manager</a></li>
                                <li>Footer</li>
                            </ol>
                            <h1><span>Menu Group Editor</span>
                                <small></small>
                                <span class="pull-right"><span><span class="pull-right"><a href="/tbd" target="_blank"><i class="fa fa-question-circle"></i></a></span></span></span></h1>
                        </section>
                    </div>
                    <section class="content">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class=""><a href="/admin/belt/menu/menu-groups/edit/3" class="router-link-active"><span class="hidden-sm hidden-xs">Main</span> <i class="fa fa-home visible-sm visible-xs"></i></a></li>
                                <li class=""><a href="/admin/belt/menu/menu-groups/edit/3/menu-items" class="router-link-active">Items</a></li>
                            </ul>
                            <div class="tab-content">
                                <div>
                                    <form>
                                        <div>
                                            <div class="form-group"><label for="subtype">Type</label> <select name="subtype" class="form-control">
                                                    <option value="default">Default</option>
                                                    <option value="list">List</option>
                                                    <option value="page">Page</option>
                                                    <option value="place">Place</option>
                                                    <option value="social_media">Social Media</option>
                                                </select></div>
                                        </div>
                                        <div class="form-group"><label for="name">Parent Menu Item</label> <input type="hidden">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                <input readonly="readonly" class="form-control"> <!----></div>
                                        </div> <!---->
                                        <div class="form-group"><label for="name">Name</label> <input placeholder="name" class="form-control"></div>
                                        <div class="text-right">
                                            <button class="btn btn-primary"><span>save</span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

        </div>
    </div>
</section>