@extends('sites.layouts.main')
@section('content')

    <div class="content-box profile-page dashboard-content" id="dashboard">

        @include('_include.errors')
        <div class="content-box analytics-page">
            <div class="tab-content">
                <div class="tab-content" id="pills-tabContent">
                   <div class="container">
                       <!-- /.col -->
                       <div class="col-md-12 p-1">
                           <div class="row">
                               <div class="col-md-3 p-1">
                                   @include('sites.profiles.partials.about')
                               </div>
                               <!-- /.col -->
                               <div class="col-md-9 p-1">
                                   <div class="card">
                                       <div class="card-header p-2">
                                           <ul class="nav nav-pills" id="item-nav">
                                               <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Подписчики</a></li>
                                               <li class="nav-item"><a class="nav-link " href="#activity" data-toggle="tab">Отчеты</a></li>
                                               @if(request()->user()->id === (int) request()->route('id'))
                                               <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Параметры</a></li>
                                               @endif
                                           </ul>
                                       </div><!-- /.card-header -->
                                       <div class="card-body p-1">
                                           <div class="tab-content">
                                               @include('sites.profiles.partials.tabs.contacts')
                                               @include('sites.profiles.partials.tabs.reporting')
                                               @include('sites.profiles.partials.tabs.info')
                                           </div>
                                       </div><!-- /.card-body -->
                                   </div>
                                   <!-- /.card -->
                               </div>
                               <!-- /.col -->
                           </div>
                           <!-- /.card -->
                       </div>
                       <!-- /.col -->
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
            src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_PLACE_KEY') }}&language=ru&libraries=places&callback=initMap"
            defer></script>

    <script type="text/javascript" src="{{ asset('js/place_input.js') }}"></script>

    <script>

        $('div.alert.alert-success').delay(2000).slideUp(300)
        $('div.alert.alert-danger').delay(3000).slideUp(300)

        $('#subscription').on('click', function(el) {
            el.preventDefault();

            const url = "{{ route('customer.subscription.contact', $user->id) }}";
            $.ajax({
                url: url,
                type: 'POST',
                data: { userId: "{{ $user->id }}", _token: '{{csrf_token()}}' },
                success: function () {
                    $('#subscription').text('Запрос отправлен').addClass('pointer-element');
                }
            });
        });

        function ajaxLoader() {
            let pageNext = document.getElementById('page').value;
            let page = Number(pageNext) + 1;
            var id = window.location.href.split('/').pop();
            var url = "{{ route('customer.load.report') }}" + "?page=" + page;

            $.ajax({
                type: 'GET',
                url: url,
                data: {id: id},
                success: function (data) {
                    var reports = data.data;
                    if (data.pageOff == true) {
                        document.getElementById('btn1').style.display = 'none';
                    }

                    document.getElementById('page').value = data.page;
                    const element = document.createElement('div');
                    document.querySelector('#loadMoreReportUser').appendChild(element);

                    for (var i = 0; i < reports.length; i++) {
                        element.insertAdjacentHTML('beforebegin', reportUserDomElement(reports[i]));
                    }
                }
            });
        }

        function getDate(value) {
            d = new Date(value);
            return (d.getDate() < 10 ? '0' : '') + d.getDate() + '.' +
                ((d.getMonth() + 1) < 10 ? '0' : '') + (d.getMonth() + 1) + '.' +
                d.getFullYear();
        }

        function reportUserDomElement(el) {
            let urlPost = 'https://xn--m1aaxj.xn--90ais/reports/' + el['id'];
            let newDate = getDate(el['created_at']);

            return `
                <div class="post">
                    <div class="card-body p-1">
                        <a href="${urlPost}">
                            <img class="img-fluid pad" src="${el['avatar']}" alt="Photo">
                        </a>
                        <p class="mt-2">${el['description'].substr(0, 300)}</p>
                        <div class="user-block d-flex justify-content-between align-items-end m-0">
                            <span class="description m-0">Опубликован - ${newDate}</span>
                            <button type="button" class="btn btn-default btn-sm">
                                <i class="far fa-comment"></i>
                                ${el['commentCount']}
                            </button>
                        </div>
                    </div>
                </div>`
        }

        checkboxes = Array.from(document.querySelectorAll('.banned'));
        checkboxes.forEach(function(checkbox, i) {

            checkbox.onchange = function() {
                $.ajax({
                    url: '{{ route('customer.subscription.ban',$user->id) }}',
                    type: 'PATCH',
                    data: {
                        _token: '{{csrf_token()}}',
                        id: {{request()->user()->id}},
                        followId: this.value,
                        checked: this.checked ? 1 : 0
                    },
                    beforeSend: function() { checkbox.disabled = true; },
                    complete: function() { checkbox.disabled = false; },
                    success: function(response) {},
                    errorCaptured(err, vm, info) {
                        console.error(err, info)
                    }
                });
            }
        });

    </script>
@endpush