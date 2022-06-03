@extends('sites.layouts.main')

@section('content')

    <div class="content-box profile-page dashboard-content" id="dashboard">

        @include('_include.errors')

        <div class="container  mt-5  px-lg-5">
            <ul id="docs-nav-pills" class="nav nav-pills mb-4" role="tablist">
                <li class="nav-item">
                    <a class="nav-link px-5 font-weight-bold">Создание отчета<i class="fas fa-external-link-alt ms-1"></i></a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade in show active" id="docsTabsOverview" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-10 col-md-12 p-2">
                            <!--Section: Docs content-->
                            <section id="section-examples">
                                <section id="subsection-checkout">
                                    <!--Subsection title-->
                                    <h4 class="mt-5"> Заполните все поля а также выберите загрузку медиа.</h4>

                                    <!--Description-->
                                    <p>Под медиа подразумевается загрузка фото и видео.</p>

                                    <section class="w-100 p-2 text-center pb-4">
                                        <form action="{{ route('reporting.store') }}"
                                              id="reportNew"
                                              method="POST"
                                              enctype="multipart/form-data">
                                        @csrf
                                        <!-- Text input -->
                                            <div class="d-flex" style="justify-content: space-between;">

                                                <div class="form-group">
                                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                                            id="regionPull"
                                                            name="regionId"
                                                            required>
                                                        <option selected>Open this select menu</option>
                                                        @foreach($regions as $key => $region)
                                                            <option value="{{ $key }}">{{ $region }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Message input -->
                                            <div class="form-outline mb-4">
                                                <textarea class="form-control" name="description" id="form6Example7" rows="15">{{ old('description') }}</textarea>
                                                <label class="form-label" for="form6Example7" style="margin-left: 0px;">Подробное описание</label>
                                                <div class="form-notch">
                                                    <div class="form-notch-leading" style="width: 9px;"></div>
                                                    <div class="form-notch-middle" style="width: 135.2px;"></div>
                                                    <div class="form-notch-trailing"></div>
                                                </div>
                                            </div>

                                            <hr />
                                            <div class="form-outline mb-4 text-center">
                                                <h4 class="mb-3">Укажите место лова на карте</h4>

                                                <div id="mapReport" style="width: auto; height: 450px"></div>
                                                <input type="hidden" name="lat" id="lat" value="">
                                                <input type="hidden" name="lng" id="lng" value="">
                                            </div>

                                            <hr />
                                            <div class="example-2 col-auto mb-4 d-flex" id="uploadMediaReport" style="justify-content: space-around;">
                                                <div class="form-group">
                                                    <input type="file" name="media[gallery][]" id="file" class="input-file" multiple />
                                                    <label for="file" class="btn btn-tertiary js-labelFile">
                                                        <i class="icon fa fa-check"></i>
                                                        <span class="js-fileName">Загрузить фото</span>
                                                    </label>
                                                </div>

                                                <div class="form-group">
                                                    <input type="file" name="media[video][]" id="video" class="input-video" multiple />
                                                    <label for="video" class="btn btn-tertiary js-labelFile-video">
                                                        <i class="icon fa fa-check"></i>
                                                        <span class="js-fileName-video">Загрузить видео</span>
                                                    </label>
                                                </div>
                                            </div>

                                            <!-- Submit button -->
                                            <div class="col-auto">
                                                <button type="submit" class="btn btn-success">Создать отчет</button>
                                            </div>
                                        </form>
                                    </section>
                                </section>
                            </section>
                            <!--Section: Docs content-->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="clear"></div>

    </div>
    <!-- nav-bar menu -->
@endsection

@push('scripts')

    <!-- Google maps -->
    <script async
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDIVbuYf-Sxc456q1F_cMcWc2OoWsVJxU&libraries=places&callback=initMap"
            defer></script>

    <script type="text/javascript" src="{{ asset('js/google-map_new-report.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/report-media.js') }}"></script>
@endpush