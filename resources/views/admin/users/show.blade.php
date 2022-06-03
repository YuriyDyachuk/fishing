@extends('admin.index')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 mt-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                     src="{{ $user->getFirstMediaUrl('media') }}"
                                     alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ $user->name }}</h3>

                            <p class="text-muted text-center">{{ $user->city }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Отчетов</b> <a class="float-right">{{ $user->reports()->count() }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Подписчики</b> <a class="float-right">{{ $user->follows()->count() }}</a>
                                </li>
                            </ul>

                            @if(auth()->user()->id !== (int) request()->route('id'))
                                <a href="#"
                                   class="btn btn-primary btn-block">
                                    <b>Отправить запрос</b>
                                </a>
                            @endif
                            @if(auth()->user()->id === (int) request()->route('id'))
                                <a class="btn btn-success btn-block"
                                   href="{{ route('reporting.create') }}"
                                   role="button">Добавить отчет</a>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Обо мне</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-user-clock mr-1"></i> Возраст</strong>

                            <p class="text-muted">
                                {{ $user->age() }}
                            </p>

                            <hr>

                            <strong><i class="fas fa-pencil-alt mr-1"></i> Обо мне</strong>

                            <p class="text-muted">
                                {{ $user->bio }}
                            </p>

                            <hr>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Город</strong>

                            <p class="text-muted">{{ $user->city }}</p>

                            <hr>

                            <strong><i class="fas fa-list-ol mr-1"></i> Интересы</strong>

                            <p class="text-muted">
                                <span class="tag tag-info">🎣</span>
                            </p>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9 mt-3">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#report" data-toggle="tab">Отчеты</a></li>
                                <li class="nav-item"><a class="nav-link" href="#subscriber" data-toggle="tab">Подписчики</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="report">
                                    <!-- Post -->
                                    @foreach($user->reports as $report)
                                        <div class="post">
                                            <div class="card-body">
                                                <div class="user-block">
                                                    <img class="img-circle" src="{{ $report->user->getFirstMediaUrl('media') }}" alt="User Image">
                                                    <span class="username">{{ $report->user->name }}</span>
                                                    <span class="description">Опубликован - {{ $report->customDate }}</span>
                                                </div>

                                                <a href="{{ route('admin.reports.show', $report->id) }}">
                                                    <img class="img-fluid pad" src="{{ $report->getFirstMediaUrl('gallery', 'small') }}" alt="Photo">
                                                </a>

                                                <p>{{ mb_strimwidth($report->description, 0, 300, '...') }}</p>
                                                <button type="button" class="btn btn-default btn-sm"><i class="far fa-comment"></i>
                                                    {{ $report->comments->count() }}</button>
                                            </div>
                                            <!-- /.card-body -->
                                            <div class="card-footer card-comments">
                                                @foreach($report->comments()->limit(2)->get() as $comment)
                                                    <div class="card-comment">
                                                        <!-- User image -->
                                                        <img class="img-circle img-sm" src="{{ $comment->user->getFirstMediaUrl('media') }}" alt="User Image">

                                                        <div class="comment-text">
                                                        <span class="username">
                                                          {{ $comment->user->name }}
                                                          <span class="text-muted float-right">{{ $comment->customDate }}</span>
                                                        </span><!-- /.username -->
                                                            {{ $comment->body }}
                                                        </div>
                                                        <!-- /.comment-text -->
                                                    </div>
                                                @endforeach
                                                <!-- /.card-comment -->
                                            </div>
                                            <!-- /.card-footer -->
                                        </div>
                                    @endforeach
                                    <!-- /.post -->
                                </div>
                                <div class="tab-pane" id="subscriber">
                                    <div class="card-body pb-0">
                                        <div class="row">
                                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                                <div class="card bg-light d-flex flex-fill">
                                                    <div class="card-header text-muted border-bottom-0">
                                                        Digital Strategist
                                                    </div>
                                                    <div class="card-body pt-0">
                                                        <div class="row">
                                                            <div class="col-7">
                                                                <h2 class="lead"><b>Nicole Pearson</b></h2>
                                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52</li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-5 text-center">
                                                                <img src="../../dist/img/user1-128x128.jpg" alt="user-avatar" class="img-circle img-fluid">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="text-right">
                                                            <a href="#" class="btn btn-sm bg-teal">
                                                                <i class="fas fa-comments"></i>
                                                            </a>
                                                            <a href="#" class="btn btn-sm btn-primary">
                                                                <i class="fas fa-user"></i> View Profile
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                                <div class="card bg-light d-flex flex-fill">
                                                    <div class="card-header text-muted border-bottom-0">
                                                        Digital Strategist
                                                    </div>
                                                    <div class="card-body pt-0">
                                                        <div class="row">
                                                            <div class="col-7">
                                                                <h2 class="lead"><b>Nicole Pearson</b></h2>
                                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52</li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-5 text-center">
                                                                <img src="../../dist/img/user2-160x160.jpg" alt="user-avatar" class="img-circle img-fluid">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="text-right">
                                                            <a href="#" class="btn btn-sm bg-teal">
                                                                <i class="fas fa-comments"></i>
                                                            </a>
                                                            <a href="#" class="btn btn-sm btn-primary">
                                                                <i class="fas fa-user"></i> View Profile
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                                <div class="card bg-light d-flex flex-fill">
                                                    <div class="card-header text-muted border-bottom-0">
                                                        Digital Strategist
                                                    </div>
                                                    <div class="card-body pt-0">
                                                        <div class="row">
                                                            <div class="col-7">
                                                                <h2 class="lead"><b>Nicole Pearson</b></h2>
                                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52</li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-5 text-center">
                                                                <img src="../../dist/img/user1-128x128.jpg" alt="user-avatar" class="img-circle img-fluid">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="text-right">
                                                            <a href="#" class="btn btn-sm bg-teal">
                                                                <i class="fas fa-comments"></i>
                                                            </a>
                                                            <a href="#" class="btn btn-sm btn-primary">
                                                                <i class="fas fa-user"></i> View Profile
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                                <div class="card bg-light d-flex flex-fill">
                                                    <div class="card-header text-muted border-bottom-0">
                                                        Digital Strategist
                                                    </div>
                                                    <div class="card-body pt-0">
                                                        <div class="row">
                                                            <div class="col-7">
                                                                <h2 class="lead"><b>Nicole Pearson</b></h2>
                                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52</li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-5 text-center">
                                                                <img src="../../dist/img/user2-160x160.jpg" alt="user-avatar" class="img-circle img-fluid">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="text-right">
                                                            <a href="#" class="btn btn-sm bg-teal">
                                                                <i class="fas fa-comments"></i>
                                                            </a>
                                                            <a href="#" class="btn btn-sm btn-primary">
                                                                <i class="fas fa-user"></i> View Profile
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                                <div class="card bg-light d-flex flex-fill">
                                                    <div class="card-header text-muted border-bottom-0">
                                                        Digital Strategist
                                                    </div>
                                                    <div class="card-body pt-0">
                                                        <div class="row">
                                                            <div class="col-7">
                                                                <h2 class="lead"><b>Nicole Pearson</b></h2>
                                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52</li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-5 text-center">
                                                                <img src="../../dist/img/user1-128x128.jpg" alt="user-avatar" class="img-circle img-fluid">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="text-right">
                                                            <a href="#" class="btn btn-sm bg-teal">
                                                                <i class="fas fa-comments"></i>
                                                            </a>
                                                            <a href="#" class="btn btn-sm btn-primary">
                                                                <i class="fas fa-user"></i> View Profile
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                                <div class="card bg-light d-flex flex-fill">
                                                    <div class="card-header text-muted border-bottom-0">
                                                        Digital Strategist
                                                    </div>
                                                    <div class="card-body pt-0">
                                                        <div class="row">
                                                            <div class="col-7">
                                                                <h2 class="lead"><b>Nicole Pearson</b></h2>
                                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52</li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-5 text-center">
                                                                <img src="../../dist/img/user1-128x128.jpg" alt="user-avatar" class="img-circle img-fluid">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="text-right">
                                                            <a href="#" class="btn btn-sm bg-teal">
                                                                <i class="fas fa-comments"></i>
                                                            </a>
                                                            <a href="#" class="btn btn-sm btn-primary">
                                                                <i class="fas fa-user"></i> View Profile
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                                <div class="card bg-light d-flex flex-fill">
                                                    <div class="card-header text-muted border-bottom-0">
                                                        Digital Strategist
                                                    </div>
                                                    <div class="card-body pt-0">
                                                        <div class="row">
                                                            <div class="col-7">
                                                                <h2 class="lead"><b>Nicole Pearson</b></h2>
                                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52</li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-5 text-center">
                                                                <img src="../../dist/img/user1-128x128.jpg" alt="user-avatar" class="img-circle img-fluid">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="text-right">
                                                            <a href="#" class="btn btn-sm bg-teal">
                                                                <i class="fas fa-comments"></i>
                                                            </a>
                                                            <a href="#" class="btn btn-sm btn-primary">
                                                                <i class="fas fa-user"></i> View Profile
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                                <div class="card bg-light d-flex flex-fill">
                                                    <div class="card-header text-muted border-bottom-0">
                                                        Digital Strategist
                                                    </div>
                                                    <div class="card-body pt-0">
                                                        <div class="row">
                                                            <div class="col-7">
                                                                <h2 class="lead"><b>Nicole Pearson</b></h2>
                                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52</li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-5 text-center">
                                                                <img src="../../dist/img/user1-128x128.jpg" alt="user-avatar" class="img-circle img-fluid">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="text-right">
                                                            <a href="#" class="btn btn-sm bg-teal">
                                                                <i class="fas fa-comments"></i>
                                                            </a>
                                                            <a href="#" class="btn btn-sm btn-primary">
                                                                <i class="fas fa-user"></i> View Profile
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                                <div class="card bg-light d-flex flex-fill">
                                                    <div class="card-header text-muted border-bottom-0">
                                                        Digital Strategist
                                                    </div>
                                                    <div class="card-body pt-0">
                                                        <div class="row">
                                                            <div class="col-7">
                                                                <h2 class="lead"><b>Nicole Pearson</b></h2>
                                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52</li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-5 text-center">
                                                                <img src="../../dist/img/user2-160x160.jpg" alt="user-avatar" class="img-circle img-fluid">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="text-right">
                                                            <a href="#" class="btn btn-sm bg-teal">
                                                                <i class="fas fa-comments"></i>
                                                            </a>
                                                            <a href="#" class="btn btn-sm btn-primary">
                                                                <i class="fas fa-user"></i> View Profile
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <nav aria-label="Contacts Page Navigation">
                                            <ul class="pagination justify-content-center m-0">
                                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                                <li class="page-item"><a class="page-link" href="#">5</a></li>
                                                <li class="page-item"><a class="page-link" href="#">6</a></li>
                                                <li class="page-item"><a class="page-link" href="#">7</a></li>
                                                <li class="page-item"><a class="page-link" href="#">8</a></li>
                                            </ul>
                                        </nav>
                                    </div>
                                    <!-- /.card-footer -->
                                </div>
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection