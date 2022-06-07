<!-- /.profile-panel -->
<div class="tab-pane" id="timeline">
    <!-- /.card-header -->
    <div class="card-body p-1">
        <div class="tab-pane" id="subscriber">
            <div class="card-body p-1 pb-0">
                <div class="row">
                    <!-- Followers -->
                    <div id="loadMoreFollowerUser" class="p-1"></div>
                    <!-- /.followers -->
                    <div class="col-12 col-auto text-center loader__btn mt-5" id="loadMoreProfile">
                        <input type="hidden" id="pageFollow" value="0">
                        <button id="btn2" class="trigger btn" onclick="ajaxLoaderFollower()" style="opacity: 1;">Загрузить</button>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <!-- /.card-body -->

</div>
<!-- /.friend-pane -->