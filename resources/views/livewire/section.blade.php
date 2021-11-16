<div class="container-fluid">
    <div class="row">
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-header" style="background: #1f2833; color: #edf6ff">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="#addSection" class="btn btn-primary" data-toggle="modal">
                                <i class="fa fa-plus fa-lg"> Add Section </i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @include('sections.table')
                </div>
            </div>
        </div>
    </div>
    @include('sections.create')
</div>

