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
                                     src="@if($user->media('media')->exists()) {{ $user->getFirstMediaUrl('media') }} @else {{ asset('images/user/user-128.png') }} @endif"
                                     alt="User profile picture"
                                style="width: 80px; height: 80px;"   >
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
                                                    <img class="img-circle" src="@if($report->user->media('media')->exists()) {{ $report->user->getFirstMediaUrl('media') }} @else {{ asset('images/user/user-128.png') }} @endif"
                                                         style="width: 80px;height: 80px;"
                                                         alt="User Image">
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
                                                        <img class="img-circle img-sm" src="@if($comment->user->media('media')->exists()) {{ $comment->user->getFirstMediaUrl('media') }} @else {{ asset('images/user/user-128.png') }} @endif"
                                                             style="width: 80px;height: 80px;"
                                                             alt="User Image">

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