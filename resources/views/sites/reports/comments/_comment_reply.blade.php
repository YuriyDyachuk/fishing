@foreach($comments as $comment)
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <div class="d-flex flex-col" style="margin-left: 25px;">
            <div class="ms-3 flex align-items-center">
                <a href="{{ route('customer.profile.show', $comment->user->id) }}">
                    <img src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt="" style="width: 45px; height: 45px"
                         class="rounded-circle" />
                </a>
                <small class="fw-hold ml-2 p-2">{{ $comment->user->name }} {{ \Carbon\Carbon::make($comment->created_at)->format('d.m.Y') }} в {{ \Carbon\Carbon::make($comment->created_at)->format('H.i') }}</small>
            </div>
            <div class="ms-3 mt-2">
                <p class="text-muted mb-0">{{ $comment->body }}</p>
            </div>
        </div>

        <div class="d-flex align-text-right flex-col">
            <a class="btn btn-link btn-rounded btn-sm" role="button" id="likeComment">
                <i class="far fa-thumbs-up"></i>
            </a>
            <a class="btn btn-link btn-rounded btn-sm" role="button" id="sendComment">
                <i class="far fa-comment"></i>
            </a>
            @auth()
                <a class="btn btn-link btn-rounded btn-sm" role="button" id="editComment">
                    <i class="fas fa-pen"></i>
                </a>
            @endauth
        </div>
    </li>
    @include('sites.reports.comments.reaply_form')
    @include('sites.reports.comments._comment_reply', ['comments' => $comment->replies])
@endforeach