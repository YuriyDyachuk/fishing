@extends('sites.layouts.main')

@section('content')

    <div class="container reports__cart" style="min-height: 600px;">
        @include('_include.errors')
        @if($followers->count())
        <table class="table align-middle mb-0 bg-white text-center">
            <thead class="bg-light">
            <tr>
                <th>Имя</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($followers as $follower)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <img
                                    src="@if($follower->media('media')->exists()) {{ $follower->getFirstMediaUrl('media') }}
                                    @else {{ asset('images/user/user-128.png') }}
                                    @endif"
                                    alt="ava"
                                    style="width: 50px; height: 50px"
                                    class="rounded-circle"
                            />
                            <div class="ms-3">
                                <p class="fw-bold mb-1">{{ $follower->name }}</p>
                                <p class="text-muted mb-0">{{ $follower->city ?? '' }}</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <form class="mb-1" action="{{ route('customer.profile.subscriber.apply', [request()->user()->id, $follower->id]) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                    class="btn btn- dz-success btn-sm">
                                <i class="fas fa-user-friends"></i> Принять
                            </button>
                        </form>
                        <form action="{{ route('customer.profile.subscriber.cancel', [request()->user()->id, $follower->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-restore"></i> Отменить
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @else
            <h5 class="text-center pt-5">Новых подписок не найдено.</h5>
        @endif
    </div>
@endsection