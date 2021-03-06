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

        <p class="text-muted text-center">@if(!is_null($user->city)) г. {{ $user->city }} @endif</p>

        <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
                <b>Отчеты</b> <a class="float-right">{{ $user->countReportPublished()}}</a>
            </li>
            <li class="list-group-item">
                <b>Друзья</b> <a class="float-right">{{ $user->isConfirmFollowersCount() }}</a>
            </li>
        </ul>

        @if(request()->user()->id !== (int) request()->route('id'))
            @if(request()->user()->isActiveSendFollowing($user->id))
                <a class="btn btn-success"
                   id="subscription"
                   role="button">Запрос отправлен
                </a>
            @elseif(!in_array(request()->user()->id, $user->getIdFollower()) && !request()->user()->ban)
                <a class="btn btn-success"
                   id="subscription"
                   href="{{ route('customer.subscription.contact', $user->id) }}"
                   role="button">Отправить запрос
                </a>
            @else
            @endif
        @endif
        @if(request()->user()->id == (int) request()->route('id'))
            <a class="btn btn-success btn-block @if(request()->user()->ban) d-none @endif"
               href="{{ route('reporting.create') }}"
               role="button">Добавить отчет</a>

            @if(request()->user()->ban)
                <span class="text-sm alert-danger d-flex text-center mb-2">Профиль заблокирован администрацией</span>
                <a class="btn btn-warning btn-block"
                   href="{{ route('customer.support.create') }}"
                   role="button">Написать в поддержку</a>
            @endif

        @endif

        @if(request()->user()->id !== (int) request()->route('id') && in_array(request()->user()->id, $user->getIdFollower()) && !request()->user()->ban)
            <form action="{{ route('customer.profile.subscriber.cancel', [request()->user()->id, $user->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="btn btn-danger mt-1" style="width: 100%;">
                    <i class="fas fa-trash-restore"></i> Отменить подписку
                </button>
            </form>
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