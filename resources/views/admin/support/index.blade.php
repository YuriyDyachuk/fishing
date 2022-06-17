@extends('admin.index')

@section('content')

    <section class="content">
        <div class="container-fluid">
            @include('admin._include.errors')
            <table class="table align-middle mb-0 bg-white">
                <thead class="bg-light">
                <tr>
                    <th>Иия</th>
                    <th>Сообщение</th>
                    <th>Статус</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($supports as $support)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <a href="{{ route('admin.users.show', $support->user->id) }}">
                                    <img
                                            src="{{ $support->user->getFirstMediaUrl('media') }}"
                                            alt=""
                                            style="width: 45px; height: 45px"
                                            class="rounded-circle"
                                    />
                                </a>
                                <div class="ms-3 ml-1">
                                    <p class="fw-bold mb-1">{{ $support->user->name }}</p>
                                    <p class="text-muted mb-0">{{ $support->user->city }}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="fw-normal mb-1">{{ mb_strimwidth($support->message, 0, 30, '...') }}</p>
                        </td>
                        <td>
                            @if(!$support->status)
                                <span class="badge badge-danger rounded-pill d-inline">
                                    <i class="fa fa-user-slash"></i>
                                </span>
                            @else
                                <span class="badge badge-success rounded-pill d-inline">
                                    <i class="fa fa-user"></i>
                                </span>
                            @endif
                        </td>
                        <td class="project-actions text-right d-flex justify-content-around">
                            <a class="btn btn-info btn-sm" href="{{ route('supports.show', $support->id) }}">
                                <i class="fas fa-eye">
                                </i>
                                Show
                            </a>
                            <form action="{{ route('supports.destroy', $support->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Вы уверены, что хотите удалить данную запись?')"
                                        class="btn btn-link btn-sm btn-danger">
                                    <span style="color: white;">Удалить</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center m-1 mt-2">
                {{ $supports->links("pagination::bootstrap-4") }}
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script>
        $('div.alert.alert-success').delay(3000).slideUp(300)
        $('div.alert.alert-danger').delay(4000).slideUp(300)
    </script>
@endpush