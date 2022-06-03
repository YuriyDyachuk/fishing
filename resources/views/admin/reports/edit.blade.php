@extends('admin.index')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-2 mt-3">
                </div>
                <div class="col-12">
                    <div class="card mt-3">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('admin.reports.update', $report->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="col d-flex">
                                    <div class="form-group col-4">
                                        <div class="form-group">
                                            <label>Регион</label>
                                            <select class="form-control"
                                                    id="regionPull"
                                                    name="regionId">
                                                @foreach($regions as $region)
                                                    <option value="@if($report->region->id === $region['id']) {{ $report->region->id}} @else {{ $region['id'] }} @endif"
                                                            @if($report->region->id == $region['id']) selected @endif>{{ $region['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="custom-control custom-switch">
                                            <input type="checkbox"
                                                   name="status"
                                                   class="custom-control-input"
                                                   id="customSwitch1"
                                                   @if($report->publish) checked @endif />
                                            <label class="custom-control-label" for="customSwitch1"> @if($report->publish) Отчет опубликован @else Отчет на модерации @endif  </label>
                                        </div>
                                    </div>

                                    <div class="form-group col-8">
                                        <div id="mapReport" style="width: 100%; height: 450px"></div>
                                        <input type="hidden" name="lat" id="lat" value="{{ $report->lat }}">
                                        <input type="hidden" name="lng" id="lng" value="{{ $report->lng }}">
                                    </div>
                                </div>

                                <hr />

                                <!-- textarea -->
                                <div class="form-group">
                                    <label>Описание</label>
                                    <textarea class="form-control"
                                              rows="10"
                                              name="description"
                                              placeholder="Enter ...">{{ $report->description }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-warning">Опубликовать отчет</button>
                            </form>
                        </div>

                        <div class="card card-gray collapsed-card">
                            <div class="card-header">
                                <h3 class="card-title">Media</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body mb-3 row" style="display: none;">
                                <div class="col-sm-12">
                                    <p class="text-center">Доступна функция - Drag and Drop Sorting</p>
                                    <div class="row justify-content-center" id="scrollbarMedia" style="cursor: move;">
                                        @foreach($report->getMedia('gallery')->sortBy('custom_properties.position') as $key => $media)
                                            <div class="col-sm-3 draggable"
                                                 id="pos__{{ $media->id }}"
                                                 draggable="true">
                                                <img class="img-fluid mb-3"
                                                     src="{{ $media->getUrl('small') }}"
                                                     style="height: 74%!important"
                                                     alt="Photo">
                                                <form action="{{ route('admin.reports.media.delete', [$report->id, $media->uuid]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="btn btn-danger"
                                                            style="position: relative;top: -54px;">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- /.row -->
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <div class="card card-primary collapsed-card">
                            <div class="card-header">
                                <h3 class="card-title">Video</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body mb-3 row" style="display: none;">
                                <div class="col-sm-12">
                                    <div class="row justify-content-center">
                                        @foreach($report->getMedia('media') as $media)
                                            <div class="col-sm-4">
                                                <iframe
                                                        src="{{ $media->getUrl() }}"
                                                        title="report video"
                                                        allowfullscreen

                                                ></iframe>
                                                &nbsp;
                                                <form action="{{ route('admin.reports.media.delete', [$report->id, $media->uuid]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="btn btn-danger"
                                                            style="position: relative;top: -54px;">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@push('scripts')

    <!-- Google maps -->
    <script async
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDIVbuYf-Sxc456q1F_cMcWc2OoWsVJxU&libraries=places&callback=initMap"
            defer></script>
    {{--  Init map Google API  --}}
    <script type="text/javascript" src="{{ asset('js/google-map_new-report.js') }}"></script>

    <script>
        $(function() {

            if ($("#scrollbarMedia").length) {
                var sortable = new Sortable(scrollbarMedia, {
                    draggable: ".draggable",
                    onEnd: function (evt) {
                        console.log(evt);
                        updSortEl();
                    },
                });
            }
        });

        function updSortEl(){

            let elements_sorted = {};
            $('.draggable').each(function(index){
                let elId = $(this).attr('id').split('__');
                elements_sorted[parseInt(elId[1])] = ++index;
            });
            console.log(elements_sorted);

            $.ajax({
                url     : '{{ route('admin.report.media.position', $report->id) }}',
                type    : 'POST',
                data    : {'position' : elements_sorted},
                dataType: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    "cache-control": "no-cache, no-store"
                }})
                .done(function (data) {

                })
                .fail(function (data) {
                    console.warn(data);
                });
        }
    </script>


@endpush