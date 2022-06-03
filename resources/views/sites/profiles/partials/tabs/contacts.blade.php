<div class="row">
    @foreach($user->followersConfirm as $friend)
        <div class="col-xl-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <a href="{{ route('customer.profile.show', $friend->id) }}">
                                <img
                                        src="https://mdbootstrap.com/img/new/avatars/8.jpg"
                                        alt=""
                                        style="width: 45px; height: 45px"
                                        class="rounded-circle"
                                />
                            </a>
                            <div class="ms-3">
                                <p class="fw-bold mb-1">{{ $friend->name }}</p>
                                <p class="text-muted mb-0">{{ $friend->email }}</p>
                            </div>
                        </div>
                        <span class="badge rounded-pill @if(!auth()->user()->isFollowBanned($friend->id)) badge-success @else badge-danger @endif">
                            @if(!auth()->user()->isFollowBanned($friend->id)) Active @else Banned @endif
                        </span>
                    </div>
                </div>
                @if(auth()->user()->isFollowConfirm($friend->id))
                <div
                        class="card-footer border-0 bg-light p-2 d-flex justify-content-around"
                >
                    <a
                            class="btn btn-link m-0 text-reset"
                            href="#"
                            role="button"
                            data-ripple-color="primary"
                    >Message<i class="fas fa-envelope ms-2"></i
                        ></a>
                    @if(!auth()->user()->isFollowBanned($friend->id))
                        <form action="{{ route('customer.subscription.ban', $friend->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="friendId" value="{{ $friend->id }}">
                            <button type="submit" class="btn btn-danger">Bun <i class="fas fa-ban"></i></button>
                        </form>
                    @else
                        <form action="{{ route('customer.subscription.unban', $friend->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="friendId" value="{{ $friend->id }}">
                            <button type="submit" class="btn btn-warning">Unbun <i class="fas fa-ban"></i></button>
                        </form>
                    @endif
                </div>
                @endif
            </div>
        </div>
    @endforeach
</div>