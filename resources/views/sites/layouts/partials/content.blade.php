@extends('sites.layouts.main')

@section('content')

    <!-- Div the parallax scrolling effect -->
    <div class="parallax">
        <!-- Main content -->
        <div class="container d-flex flex-row justify-content-around mb-4 map-wrapper" style="margin-top: 100px;">
            <div class="padding-right-0 d-none" id="locations-map">
                <div class="region d-flex flex-column align-items-center m-2 mt-4">
                    <label for="region" class="pr-1 w-100 text-center">Укажите регион:</label>
                    <select class="btn btn-default float-left"
                            id="region"
                            name="region"
                            aria-label="Default select example">
                        <option value="0" selected>Все</option>
                        <option value="1">Брестская область</option>
                        <option value="2">Витебская область</option>
                        <option value="3">Гомельская область</option>
                        <option value="4">Гродненская область</option>
                        <option value="5">Минская область</option>
                        <option value="6">Могилевская область</option>
                    </select>
                </div>
                <div class="line_segment--date_of_range d-flex flex-column align-items-center m-2 mt-3">
                    <label for="line_segment_date_of_range" class="pr-1 text-center w-100 ">Укажите дату:</label>
                    <input {{-- onchange="onDateChange(this);" --}} id="mapDate" type="date" class="form-control" name="date">
                </div>

                <div class="line_segment--date_of_range d-flex flex-column align-items-center m-2 mt-3">
                    <label for="line_segment_date_of_range" class="pr-1 text-center w-100 ">Укажите несколько дат:</label>
                    <input type="text" class="form-control" id="mapDateRange" name="datefilter" value="" />
                </div>

                <div class="line_segment--date_of_range d-flex flex-column align-items-center m-2 mt-3">
                    <a id="collectGroup"
                       class="btn btn-outline-warning btn-sm mt-3">Показать</a>
                </div>
            </div>

            <div id="menu-show"></div>
            <div id="map"></div>
            <div class="location" data-events="{{ $reports }}"></div>
        </div>
    </div>

    <section class="content__list">
        <div class="content-fluid">
            @include('sites.layouts.partials._block')
        </div>
    </section>

@endsection

@push('scripts')

    <!-- Google maps -->
    <script async
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDIVbuYf-Sxc456q1F_cMcWc2OoWsVJxU&libraries=places&callback=initMap"
            defer></script>
    <script src="{{ asset('js/google-map.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

    <script>
        $('#menu-show').click(function () {
            $('#locations-map').toggleClass('d-none d-block');
        });

        $('input[name="datefilter"]').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear',
                format: 'YYYY-MM-DD'
            }
        });

        $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        });

        $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    </script>
@endpush