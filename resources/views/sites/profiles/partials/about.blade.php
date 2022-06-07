<!-- Profile Image -->
<div class="card card-primary card-outline">
    <div class="card-body box-profile">
        <div class="text-center">
            <img class="profile-user-img img-fluid img-circle"
                 src="@if($user->media('media')->exists()) {{ $user->getFirstMediaUrl('media') }} @else {{ asset('images/user/user-128.png') }} @endif"
                 alt="User profile picture"
                 style="width: 50px;height: 50px; border: none;">
        </div>

        <h3 class="profile-username text-center">{{ $user->name }}</h3>

        <p class="text-muted text-center">г. {{ $user->city }}</p>

        <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
                <b>Reports</b> <a class="float-right">{{ $user->reports()->count()}}</a>
            </li>
            <li class="list-group-item">
                <b>Friends</b> <a class="float-right">{{ $user->isConfirmFollowersCount() }}</a>
            </li>
        </ul>

        @if(auth()->user()->id !== (int) request()->route('id'))
            @if(auth()->user()->isActiveSendFollowing($user->id))
                <a class="btn btn-success"
                   id="subscription"
                   role="button">Запрос отправлен
                </a>
            @else
                <a class="btn btn-success @if(auth()->user()->isActiveSendFollowing($user->id))  @else d-none @endif"
                   id="subscription"
                   href="{{ route('customer.subscription.contact', $user->id) }}"
                   role="button">
                    @if(auth()->user()->isActiveSendFollowing($user->id))
                        Подтвердить подписку
                    @endif Активный подписчик</a>
            @endif
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
        <h3 class="card-title">About Me</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        @if(!is_null($user->birthday))
            <strong><i class="fas fa-user-clock mr-1"></i> Возраст</strong>

            <p class="text-muted">
                {{ $user->age() }}
            </p>

            <hr>
        @endif

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