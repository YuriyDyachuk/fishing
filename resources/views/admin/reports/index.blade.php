@extends('admin.index')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @include('_include.errors')
            <div class="row">
                <div class="col-2 mt-3">
                    <a href="{{ route('admin.reports.create') }}"
                       class="btn btn-block btn-outline-success btn-xs">Новый отчет
                    </a>
                </div>
                <div class="col-12">
                    <div class="card mt-3">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-striped projects">
                                <thead>
                                <tr>
                                    <th style="width: 1%">
                                        #
                                    </th>
                                    <th style="width: 20%">
                                        Регион
                                    </th>
                                    <th style="width: 30%">
                                        Автор
                                    </th>
                                    <th style="width: 8%" class="text-center">
                                        Status
                                    </th>
                                    <th style="width: 20%">
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($reports as $report)
                                    <tr>
                                        <td>
                                            #
                                        </td>
                                        <td>
                                            <a>
                                                {{ $report->region->name }}
                                            </a>
                                        </td>
                                        <td>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar" src="@if($report->user->media('media')->exists()) {{ $report->user->getFirstMediaUrl('media') }} @else {{ asset('images/user/user-128.png') }} @endif"
                                                    style="width: 50px;height: 50px;">
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="{{ route('admin.users.show', $report->user->id) }}" class="fw-bold">
                                                        {{ $report->user->name }}
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>
                                        <td class="project-state">
                                            <span class="badge @if(!$report->publish) badge-warning @else badge-success @endif ">
                                                @if(!$report->publish) MODERATION @else PUBLISHED @endif
                                            </span>
                                        </td>
                                        <td class="project-actions text-right d-flex justify-content-around">
                                            <a class="btn btn-primary btn-sm" href="{{ route('admin.reports.show', $report->id) }}">
                                                <i class="fas fa-folder">
                                                </i>
                                                View
                                            </a>
                                            <a class="btn btn-info btn-sm" href="{{ route('admin.reports.edit', $report->id) }}">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.reports.destroy', $report->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        onclick="return confirm('Вы уверены, что хотите удалить данний отчет?')"
                                                        class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </section>
    <!-- /.content -->
@endsection

@push('scripts')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script>
        $(function () {
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });

        $('div.alert.alert-success').delay(3000).slideUp(300)
        $('div.alert.alert-danger').delay(6000).slideUp(300)
    </script>
@endpush