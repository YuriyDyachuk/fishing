@extends('admin.index')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    @include('admin._include.errors')
                </div>
            </div>
            <div class="row">
                <div class="col-2 mt-3">
                    <a href="{{ route('admin.reports.create') }}"
                       class="btn btn-block btn-outline-success btn-xs">Новый отчет
                    </a>
                </div>
                <div class="col-12">
                    <div class="card-body">
                        <img class="img-fluid pad" src="{{ $report->getFirstMediaUrl('gallery', 'thumb') }}" alt="Photo">
                        &nbsp;
                        <div class="post clearfix mt-3">
                            <div class="user-block">
                                <img class="img-circle img-bordered-sm mr-3" src="@if($report->user->media('media')->exists()) {{ $report->user->getFirstMediaUrl('media') }} @else {{ asset('images/user/user-128.png') }} @endif"
                                     style="width: 50px;height: 50px;"
                                     alt="User Image">
                                <span class="username">
                          <a href="{{ route('admin.users.show', $report->user->id) }}">{{ $report->user->name }}</a>
                        </span>
                                <span class="description">Отчет создан - {{ $report->customDate }}</span>
                            </div>
                            <!-- /.user-block -->
                            <p>
                                {{ $report->description }}
                            </p>
                        </div>

                        <div class="card card-gray collapsed-card">
                            <div class="card-header">
                                <h3 class="card-title">Media</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body mb-3 row" style="display: none;">
                                <div class="col-sm-12">
                                    <div class="row justify-content-center">
                                        @foreach($report->getMedia('gallery') as $key => $media)
                                            <div class="col-sm-3">
                                                <img class="img-fluid mb-3"
                                                     src="{{ $media->getUrl('thumb') }}"
                                                     style="height: 74%!important"
                                                     alt="Photo">
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- /.row -->
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <div class="card card-primary collapsed-card">
                            <div class="card-header">
                                <h3 class="card-title">Video</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body mb-3 row" style="display: none;">
                                <div class="col-sm-12">
                                    <div class="row justify-content-center">
                                        @foreach($report->getMedia('media') as $media)
                                            <div class="col-sm-4">
                                                <iframe
                                                        src="{{ $media->getUrl() }}"
                                                        title="report video"
                                                        allowfullscreen

                                                ></iframe>
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer card-comments">
                        <h3 class="title">Комментарии (<span id="comment-total">{{ $report->comments->count() }}</span>)</h3>
                    </div>

                    <div class="card-body mb-3">
                        <div class="tab-content">
                            <div class="tab-pane active" id="activity">
                                <!-- Post -->
                                @foreach($report->comments as $comment)
                                    <div class="post">
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm" src="@if($comment->user->media('media')->exists()) {{ $comment->user->getFirstMediaUrl('media') }} @else {{ asset('images/user/user-128.png') }} @endif"
                                                 style="width: 50px;height: 50px;"
                                                 alt="user image">
                                            <span class="username pl-2">
                                              <a href="{{ route('admin.users.show', $comment->user->id) }}">{{ $comment->user->name }}</a>
                                            </span>
                                            <span class="description pl-2">{{ $comment->customDate }}</span>
                                        </div>
                                        <!-- /.user-block -->
                                        <p class="pl-2" style="@if($comment->is_allowed) background-color: #a3abcc; border-radius: 4px; color: white; @endif">
                                            {{ $comment->body }}
                                        </p>
                                        @if($comment->is_allowed)
                                            <form action="{{ route('admin.reports.comment.destroy', [$report->id, $comment->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash">
                                                    </i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                @endforeach
                                <!-- /.post -->
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@push('scripts')
    <script>
        $('div.alert.alert-danger').delay(6000).slideUp(300)
        $('div.alert.alert-success').delay(2000).slideUp(300)
    </script>
@endpush