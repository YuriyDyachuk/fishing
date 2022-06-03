@extends('sites.layouts.main')

@section('content')
    <div class="container reports__cart">

            <div class="reports__cart--info row row-cols-1 row-cols-md-3 g-4">
                @foreach($reports as $report)
                <div class="col" id="cart">
                    <div class="card h-100">
                        <a href="{{ route('reporting.show', $report->id) }}">
                            <img src="{{ $report->getFirstMediaUrl('gallery', 'small') }}" class="card-img-top" alt="Skyscrapers"/>
                        </a>
                        <div class="card-body">
                            <p class="card-text">{{ mb_strimwidth($report->description, 0, 200, '...') }}</p>
                        </div>
                        <div class="card-footer d-flex justify-content-around">
                            <small class="text-muted">Автор:
                                <a href="{{ route('customer.profile.show', $report->user->id) }}">{{ $report->user->name }}</a>
                            </small>
                            <small class="text-muted">{{ $report->customDate }}</small>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        <div class="col-auto text-center loader__btn">
            <input type="hidden" id="page" value="1">
            <button id="btn1" class="trigger btn" onclick="ajaxLoader()" style="opacity: 1;">Load more</button>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function ajaxLoader() {
            let pageNext = document.getElementById('page').value;
            let page = Number(pageNext) + 1;
            var url = "{{ route('reporting.load') }}" + "?page=" + page;
            console.log(url)
            $.ajax({
                type: 'GET',
                url: url,
                success: function (data) {
                    var reports = data.data;
                    if (data.pageOff == true) {
                        document.getElementById('btn1').style.display = 'none';
                    }

                    document.getElementById('page').value = data.page;
                    const element = document.createElement('div');
                    document.querySelector('.reports__cart--info').appendChild(element);

                    for (var i = 0; i < reports.length; i++) {
                        element.insertAdjacentHTML('beforebegin', reportDomElement(reports[i]));
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

        function reportDomElement(el) {
            let urlPost = window.location + '/' + el['id'];
            let urlAuthor = 'http://localhost:3030' +  '/profile/' + el['user']['id'];
            let newDate = getDate(el['created_at']);

            return `
                <div class="col" id="cart">
                    <div class="card h-100">
                        <a href="${urlPost}"><img src="${el['avatar']}" class="card-img-top" alt="Skyscrapers"/></a>
                        <div class="card-body">
                            <p class="card-text">${el['description'].substr(0, 200)}</p>
                        </div>
                        <div class="card-footer d-flex justify-content-around">
                            <small class="text-muted">Автор:
                                <a href="${urlAuthor}">${el['user']['name']}</a>
                            </small>
                            <small class="text-muted">${newDate}</small>
                        </div>
                    </div>
                </div>`;
        }

    </script>
@endpush