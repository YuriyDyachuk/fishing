<div class="row">
    @foreach($user->reports as $report)
        <div class="col-xl-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <img
                                    src="{{ $report->getFirstMediaUrl('media', 'small') }}"
                                    alt=""
                                    style="width: 45px; height: 45px"
                                    class="rounded-circle"
                            />
                            <div class="ms-3">
                                <a href="{{ route('reporting.show', $report->id) }}" class="nav__link">
                                    <p class="fw-bold mb-1">{{ $report->name }}</p>
                                </a>
                                <p class="text-muted mb-0">{{ mb_strimwidth($report->description, 0, 200, '...') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer border-0 bg-light p-2 d-flex justify-content-around">
                    <div style="color: #1266f1;">
                        <i class="fas fa-comments fa-lg"></i>
                        <span class="badge rounded-pill badge-notification bg-danger">
                            {{ $report->comments->count() }}
                        </span>
                    </div>
                    <button type="button" class="btn btn-link btn-sm btn-rounded">
                        <a href="{{ route('reporting.show', $report->id) }}">Просмотреть</a>
                    </button>
                </div>
            </div>
        </div>
    @endforeach
</div>
<div class="d-flex text-center mt-4">
    {{ $user->reports->links() }}
</div>

