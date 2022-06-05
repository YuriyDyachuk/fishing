@foreach($comments as $comment)
    <li class="list-group-item d-flex flex-column justify-content-between @if(is_null($comment->parent_id)) @else ml-4 @endif ">
        <div class="d-flex flex-row justify-content-between">
            <div class="ms-3">
                <a href="{{ route('customer.profile.show', $comment->user->id) }}">
                    <img src="@if($comment->user->media('media')->exists())
                    {{ $comment->user->getFirstMediaUrl('media') }}
                    @else {{ asset('images/user/user-128.png') }}
                    @endif" alt="ava"
                         style="width: 80px; height: 80px"
                         class="rounded-circle" />
                </a>
                <small class="fw-hold fw-5 ml-1 p-1">{{ $comment->user->name }} {{ $comment->customDate }}</small>
                <p class="fw-hold mb-1 ml-5">{{ $comment->body }}</p>
            </div>

            <div class="d-flex flex-col">
                <a class="btn btn-link btn-rounded btn-sm" role="button" id="likeComment" href="{{ $comment->id }}">
                    <i class="far fa-thumbs-up">
                        <span class="badge bg-danger ms-2 comment" id="countComment-{{ $comment->id }}"></span>
                    </i>
                </a>
            </div>
        </div>

        <div>
            <a href="" id="reply"></a>
            <form action="{{ route('customer.comment.reply') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" name="comment_body" class="form-control" />
                    <input type="hidden" name="post_id" value="{{ $report->id }}" />
                    <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-warning" value="Ответить" />
                </div>
            </form>
        </div>
        @include('sites.reports.comments._comment_replies', ['comments' => $comment->replies])
    </li>
@endforeach