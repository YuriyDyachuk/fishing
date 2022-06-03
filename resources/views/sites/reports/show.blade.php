@extends('sites.layouts.main')

@section('content')

    <div class="content-box profile-page dashboard-content" id="dashboard">

        <div class="container mt-5 px-lg-5">
            <div class="row">
                <div class="accordion-body p-1">
                    <img src="{{ $report->getFirstMediaUrl('gallery', 'small') }}" class="card-img-top" alt="Wild Landscape"/>
                </div>

                <div class="row d-flex align-items-start mb-4">
                    <div class="col">
                        <p class="text-center">Описание</p>
                        <small class="fw-hold">{{ $report->description }}</small>
                    </div>
                </div>

                <div class="accordion p-1" id="accordionPanelsStayOpenExample">

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button
                                    class="accordion-button"
                                    type="button"
                                    data-mdb-toggle="collapse"
                                    data-mdb-target="#collapseOne"
                                    aria-expanded="true"
                                    aria-controls="collapseOne"
                            >
                                <ul id="docs-nav-pills" class="nav nav-pills mb-4" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link px-5 font-weight-bold">Автор <i class="far fa-user-circle"></i></a>
                                    </li>
                                </ul>
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-mdb-parent="#accordionExample">
                            <div class="row">
                                <div class="col">
                                    <div class="card-body p-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <img
                                                        src="{{ $report->user->getFirstMediaUrl('media') }}"
                                                        alt=""
                                                        style="width: 45px; height: 45px"
                                                        class="rounded-circle"
                                                />
                                                <div class="ms-3">
                                                    <a href="{{ route('customer.profile.show', $report->user->id) }}">
                                                        <p class="fw-bold mb-1">{{ $report->user->name }}</p>
                                                    </a>
                                                    <small class="fw-hold mb-0"> г. {{ $report->user->city }}</small>
                                                </div>
                                            </div>
                                            <span class="badge rounded-pill badge-success">Active</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button" type="button" data-mdb-toggle="collapse"
                                    data-mdb-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                <ul id="docs-nav-pills" class="nav nav-pills mb-4" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link px-5 font-weight-bold">Просмотр фото <i class="far fa-images"></i></a>
                                    </li>
                                </ul>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingTwo">
                            <div class="accordion-body p-1">

                                <div id="carouselDarkVariant" class="carousel slide carousel-fade carousel-dark" data-mdb-ride="carousel">
                                    <!-- Inner -->
                                    <div class="carousel-inner">
                                        <!-- Single item -->
                                        @foreach($report->getMedia('gallery') as $k => $media)
                                            <div class="carousel-item @if($k == 0) active @endif">
                                                <img src="{{ $media->getUrl('small') }}" class="d-block w-100" alt="Motorbike Smoke"/>
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- Inner -->

                                    <!-- Controls -->
                                    <button class="carousel-control-prev" type="button" data-mdb-target="#carouselDarkVariant" data-mdb-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-mdb-target="#carouselDarkVariant" data-mdb-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($report->getMedia('media')->count() > 0)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-mdb-toggle="collapse"
                                    data-mdb-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseThree">
                                <ul id="docs-nav-pills" class="nav nav-pills mb-4" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link px-5 font-weight-bold">Просмотр видео <i class="fas fa-video"></i></a>
                                    </li>
                                </ul>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree">
                            <div class="accordion-body p-1">
                                <div class="ratio ratio-16x9">
                                    <iframe src="{{ $report->getMedia('media')->first()->getUrl() }}"
                                            title="Sites video"
                                            allowfullscreen
                                    ></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <section class="w-100 p-4 mt-4">
                    <h3 class="title">Комментарии (<span id="comment-total">{{ $report->comments->count() }}</span>)</h3>

                    <hr />

                    <ul class="list-group list-group-light mt-3">
                        @include('sites.reports.comments._comment_replies', ['comments' => $report->comments, 'reportId' => $report->id])
                    </ul>

                    <div class="ticket-comments alert alert-warning text-center m-0 @if(!auth()->user()) d-block @else d-none @endif">
                        <p class="m-0">Вы должны авторизоваться, чтобы оставлять комментарии.</p>
                        <small><a href="{{ route('login') }}">Login</a></small>
                    </div>

                    @auth()
                        <div class="pt-4">
                            <p class="fw-bold mb-1">Оставить комментарии</p>

                            <form action="{{ route('customer.comment.store') }}" method="POST">
                            @csrf
                            <!-- Message input -->
                                <div class="form-outline mb-4">
                                                            <textarea class="form-control"
                                                                      name="comment"
                                                                      id="form6Example7"
                                                                      required
                                                                      rows="4">{{ old('comment') ?? '' }}</textarea>
                                    <label class="form-label" for="form6Example7">Комментарий</label>
                                </div>
                                <!-- Submit button -->
                                <input type="hidden" name="repostId" value="{{ $report->id }}">
                                <button type="submit" class="btn btn-primary btn-block mb-4">Отправить комментарий</button>
                            </form>
                        </div>
                    @endauth
                </section>
            </div>
        </div>

        <div class="clear"></div>
        <input type="hidden" value="{{ auth()->user()->id ?? false }}" id="authId">

        <div class="d-flex text-center" id="popap">
            <p style="color: #d7614e">Для совершения действия требуется авторизация</p>
        </div>

    </div>
    <!-- nav-bar menu -->
@endsection

@push('scripts')
    <script>
        var popap = document.getElementById("popap");
        var send = document.querySelectorAll("#editComment");
        var likes = document.querySelectorAll("#likeComment");
        var countLikes = document.querySelectorAll(".comment")
        var authId = $("#authId").val();

        for (i = 0; i < countLikes.length; i++) {
            Cookies.get(countLikes[i].id) !== undefined
                ? countLikes[i].innerText = Cookies.get(countLikes[i].id)
                : '';
        }

        for (i = 0; i < likes.length; i++) {
            likes[i].addEventListener('click', function(el) {
                el.preventDefault();

                if (!authId) {
                    popap.style.left = "200px"
                    setTimeout(showPopap, 3000, popap);
                }else {

                    const url = '{{ route('customer.comment.like-add') }}';

                    const data = {
                        userId: authId,
                        commentId: $(this).attr('href'),
                        like: true,
                        _token: '{{csrf_token()}}'
                    }

                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: data,
                        success: function (data) {
                            Cookies.set('countComment-' + data.id , data.data);
                            var span = document.getElementById("countComment-" + data.id);
                            span.innerText = Cookies.get('countComment-' + data.id);
                        }
                    });
                }
            });
        }

        function showPopap(popap) {
            this.popap.style.left = "-1000px";
        }

        for (i = 0; i < send.length; i++) {
            send[i].addEventListener('click', function() {
                $('#replyForm').toggleClass('d-none', 'd-block');
            });
        }
    </script>
@endpush