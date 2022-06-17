@foreach($reports as $report)
    <div class="card flex-row align-items-center pl-1 p-2 mb-3 mr-auto ml-auto" id="content-main" style="max-width: 90%;">
        <a href="{{ route('reporting.show', $report->id) }}">
            <img src="{{ $report->getFirstMediaUrl('gallery', 'small') }}"
                 alt="Block photo"
                 style="border-radius: 2px;"
                 class="img-fluid rounded-start main-img">
        </a>
        <div class="card-body w-100 p-2 pl-3 flex-col">

            <div class="description">
                <p class="fw-bold mb-1">{{ $report->name }}</p>
                <p class="card-text">
                    {{ (mb_strimwidth(strip_tags($report->description), 0, 150, '...')) }}
                </p>
                <small class="fw-bold mb-1">Опубликован: {{ $report->customDate }}</small>
            </div>

            <div class="info-author-comment d-flex card-comment-main">
                <div class="col">
                    <span class="badge rounded-pill badge-primary">Автор</span>
                    <ul class="list-group list-group-light">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <a href="{{ route('customer.profile.show', $report->user->id) }}">
                                    <img src="@if($report->user->media('media')->exists()) {{ $report->user->getFirstMediaUrl('media') }} @else {{ asset('images/user/user-128.png') }} @endif" alt=""
                                         style="width: 50px; height: 50px"
                                         class="rounded-circle" />
                                </a>
                                <div class="ms-3">
                                    <p class="fw-bold mb-1">{{ $report->user->name }}</p>
                                    <small class="fw-hold mb-1">@if(!is_null($report->user->city)) г. {{ $report->user->city }} @endif</small>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                @if($report->comments()->where('is_allowed',false)->count())
                    <div class="col">
                        <span class="badge rounded-pill badge-success">Комментарий</span>
                        <i class="fas fa-comments"></i>
                        <span class="badge rounded-pill badge-notification bg-danger">{{ $report->comments()->where('is_allowed',false)->count() }}</span>
                        @foreach($report->comments()->latest()->where('is_allowed',false)->get()->take(1) as $comment)
                            <ul class="list-group list-group-light">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <a href="{{ route('customer.profile.show', $comment->user->id) }}">
                                            <img src="@if($comment->user->media('media')->exists()) {{ $comment->user->getFirstMediaUrl('media') }} @else {{ asset('images/user/user-128.png') }} @endif" alt=""
                                                 style="width: 50px; height: 50px"
                                                 class="rounded-circle" />
                                        </a>
                                        <div class="ms-3">
                                            <p class="fw-bold mb-1">{{ $comment->user->name }}</p>
                                            <small class="text-start mb-0">
                                                {{ mb_strimwidth($comment->body, 0, 30, '...' ) }}
                                            </small>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
@endforeach