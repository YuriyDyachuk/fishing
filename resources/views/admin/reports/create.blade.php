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
                            <form action="{{ route('admin.reports.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col d-flex" id="reportNewAdmin">
                                    <div class="form-group col-4">
                                        <div class="form-group">
                                            <label>Регион</label>
                                            <select class="form-control" name="regionId" id="regionPull">
                                                <option>Выбрать</option>
                                                @foreach($regions as $region)
                                                    <option value="{{ $region['id'] }}">{{ $region['name'] }}</option>
                                                    <option hidden data-lat="{{ $region['id'] }}" value="{{ $region['lat'] }}"></option>
                                                    <option hidden data-lng="{{ $region['id'] }}" value="{{ $region['lng'] }}"></option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="custom-control custom-switch">
                                            <input type="checkbox"
                                                   name="status"
                                                   checked
                                                   class="custom-control-input"
                                                   id="customSwitch1">
                                            <label class="custom-control-label" for="customSwitch1">Отчет опубликован</label>
                                        </div>
                                    </div>

                                    <div class="form-group col-8">
                                        <div id="mapReport" style="width: 100%; height: 450px"></div>
                                        <input type="hidden" name="lat" id="lat" value="">
                                        <input type="hidden" name="lng" id="lng" value="">
                                    </div>
                                </div>

                                <hr />

                                <!-- textarea -->
                                <div class="form-group">
                                    <label>Описание</label>
                                    <textarea class="form-control"
                                              rows="10"
                                              name="description"
                                              placeholder="Enter ...">{{ old('description') }}</textarea>
                                </div>


                                <div class="example-2 col-auto mb-4 d-flex align-item-center flex-column">
                                    <div class="row">
                                        <label>Загрузить фото:</label>
                                        <input type="file" id="fileMulti" name="media[gallery][]" multiple />
                                    </div>
                                    <div class="row">
                                        <span id="outputMulti"></span>
                                    </div>

                                    <hr />
                                    <div class="row">
                                        <label>Загрузить видео:</label>
                                        <input type="file" name="media[video][]" multiple />
                                    </div>
                                </div>
                                <hr />
                                <button type="submit" class="btn btn-success">Создать отчет</button>
                            </form>
                        </div>
                        <!-- /.card-body -->
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

    <script type="text/javascript" src="{{ asset('js/google-map_new-report.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/upload-media-report.js') }}"></script>
@endpush