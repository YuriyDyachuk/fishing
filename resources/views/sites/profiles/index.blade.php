@extends('sites.layouts.main')
@section('content')

    <div class="content-box profile-page dashboard-content" id="dashboard">

        <div class="content-box analytics-page">
            <div class="tab-content">
                <div class="tab-content" id="pills-tabContent">
                   <div class="container">
                       <!-- /.col -->
                       <div class="col-md-12 p-1">
                           <div class="row">
                               @include('_include.errors')
                               <div class="col-md-3 p-1">

                                   <!-- Profile Image -->
                                   <div class="card card-primary card-outline">
                                       <div class="card-body box-profile">
                                           <div class="text-center">
                                               <img class="profile-user-img img-fluid img-circle"
                                                    src="{{ $user->getFirstMediaUrl('media') }}"
                                                    alt="User profile picture">
                                           </div>

                                           <h3 class="profile-username text-center">{{ $user->name }}</h3>

                                           <p class="text-muted text-center">г. {{ $user->city }}</p>

                                           <ul class="list-group list-group-unbordered mb-3">
                                               <li class="list-group-item">
                                                   <b>Reports</b> <a class="float-right">{{ $user->reports()->count()}}</a>
                                               </li>
                                               <li class="list-group-item">
                                                   <b>Friends</b> <a class="float-right">{{ $user->isConfirmFollowersCount() }}</a>
                                               </li>
                                           </ul>

                                           @if(auth()->user()->id !== (int) request()->route('id'))
                                               @if(auth()->user()->isActiveSendFollowing($user->id))
                                                   <a class="btn btn-success"
                                                      id="subscription"
                                                      role="button">Запрос отправлен
                                                   </a>
                                               @else
                                                   <a class="btn btn-success @if(auth()->user()->isActiveSendFollowing($user->id))  @else d-none @endif"
                                                      id="subscription"
                                                      href="{{ route('customer.subscription.contact', $user->id) }}"
                                                      role="button">
                                                       @if(auth()->user()->isActiveSendFollowing($user->id))
                                                           Подтвердить подписку
                                                       @endif Активный подписчик</a>
                                               @endif
                                           @endif
                                           @if(auth()->user()->id === (int) request()->route('id'))
                                               <a class="btn btn-success btn-block"
                                                  href="{{ route('reporting.create') }}"
                                                  role="button">Добавить отчет</a>
                                           @endif
                                       </div>
                                       <!-- /.card-body -->
                                   </div>
                                   <!-- /.card -->

                                   <!-- About Me Box -->
                                   <div class="card card-primary">
                                       <div class="card-header">
                                           <h3 class="card-title">About Me</h3>
                                       </div>
                                       <!-- /.card-header -->
                                       <div class="card-body">
                                           @if(!is_null($user->birthday))
                                               <strong><i class="fas fa-user-clock mr-1"></i> Возраст</strong>

                                               <p class="text-muted">
                                                   {{ $user->age() }}
                                               </p>

                                               <hr>
                                           @endif

                                           <strong><i class="fas fa-pencil-alt mr-1"></i> Обо мне</strong>

                                           <p class="text-muted">
                                               {{ $user->bio }}
                                           </p>

                                           <hr>

                                           <strong><i class="fas fa-map-marker-alt mr-1"></i> Город</strong>

                                           <p class="text-muted">{{ $user->city }}</p>

                                           <hr>

                                           <strong><i class="fas fa-list-ol mr-1"></i> Интересы</strong>

                                           <p class="text-muted">
                                               <span class="tag tag-info">🎣</span>
                                           </p>

                                       </div>
                                       <!-- /.card-body -->
                                   </div>
                                   <!-- /.card -->
                               </div>
                               <!-- /.col -->
                               <div class="col-md-9 p-1">
                                   <div class="card">
                                       <div class="card-header p-2">
                                           <ul class="nav nav-pills" id="item-nav">
                                               <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Отчеты</a></li>
                                               <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Подписчики</a></li>
                                               @if(auth()->id() === (int) request()->route('id'))
                                               <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Параметры</a></li>
                                               @endif
                                           </ul>
                                       </div><!-- /.card-header -->
                                       <div class="card-body p-1">
                                           <div class="tab-content">
                                               <!-- /.profile-panel -->
                                               <div class="active tab-pane" id="activity">
                                                    <!-- Post -->
                                                   <div id="loadMoreReportUser"></div>
                                                    <!-- /.post -->
                                                   <div class="col-auto text-center loader__btn mt-5" id="loadMoreProfile">
                                                       <input type="hidden" id="page" value="0">
                                                       <button id="btn1" class="trigger btn" onclick="ajaxLoader()" style="opacity: 1;">Загрузить</button>
                                                   </div>
                                               </div>

                                               <!-- /.profile-panel -->
                                               <div class="tab-pane" id="timeline">
                                                   <!-- /.card-header -->
                                                   <div class="card-body p-1">
                                                       <div class="tab-pane" id="subscriber">
                                                           <div class="card-body p-1 pb-0">
                                                               <div class="row">
                                                                   <!-- Followers -->
                                                                   <div id="loadMoreFollowerUser" class="p-1"></div>
                                                                   <!-- /.followers -->
                                                                   <div class="col-12 col-auto text-center loader__btn mt-5" id="loadMoreProfile">
                                                                       <input type="hidden" id="pageFollow" value="0">
                                                                       <button id="btn2" class="trigger btn" onclick="ajaxLoaderFollower()" style="opacity: 1;">Загрузить</button>
                                                                   </div>
                                                               </div>

                                                               <!-- DIRECT CHAT WARNING -->
                                                               <div class="card card-warning direct-chat direct-chat-warning shadow d-none" id="chatOpen">
                                                                   <div class="card-header">
                                                                       <h3 class="card-title">Shadow - Regular</h3>

                                                                       <div class="card-tools">
                                                                           <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                                               <i class="fas fa-minus"></i>
                                                                           </button>
                                                                           <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                                               <i class="fas fa-times"></i>
                                                                           </button>
                                                                       </div>
                                                                   </div>
                                                                   <!-- /.card-header -->
                                                                   <div class="card-body">
                                                                       <!-- Conversations are loaded here -->
                                                                       <div class="direct-chat-messages">
                                                                           <!-- Message. Default to the left -->
                                                                           <div class="direct-chat-msg">
                                                                               <div class="direct-chat-infos clearfix">
                                                                                   <span class="direct-chat-name float-left">Alexander Pierce</span>
                                                                                   <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                                                                               </div>
                                                                               <!-- /.direct-chat-infos -->
                                                                               <img class="direct-chat-img" src="../dist/img/user1-128x128.jpg" alt="Message User Image">
                                                                               <!-- /.direct-chat-img -->
                                                                               <div class="direct-chat-text">
                                                                                   Is this template really for free? That's unbelievable!
                                                                               </div>
                                                                               <!-- /.direct-chat-text -->
                                                                           </div>
                                                                           <!-- /.direct-chat-msg -->

                                                                           <!-- Message to the right -->
                                                                           <div class="direct-chat-msg right">
                                                                               <div class="direct-chat-infos clearfix">
                                                                                   <span class="direct-chat-name float-right">Sarah Bullock</span>
                                                                                   <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                                                                               </div>
                                                                               <!-- /.direct-chat-infos -->
                                                                               <img class="direct-chat-img" src="../dist/img/user3-128x128.jpg" alt="Message User Image">
                                                                               <!-- /.direct-chat-img -->
                                                                               <div class="direct-chat-text">
                                                                                   You better believe it!
                                                                               </div>
                                                                               <!-- /.direct-chat-text -->
                                                                           </div>
                                                                           <!-- /.direct-chat-msg -->
                                                                       </div>
                                                                       <!--/.direct-chat-messages-->

                                                                       <!-- Contacts are loaded here -->
                                                                       <div class="direct-chat-contacts">
                                                                           <ul class="contacts-list">
                                                                               <li>
                                                                                   <a href="#">
                                                                                       <img class="contacts-list-img" src="../dist/img/user1-128x128.jpg" alt="User Avatar">

                                                                                       <div class="contacts-list-info">
                                                                              <span class="contacts-list-name">
                                                                                Count Dracula
                                                                                <small class="contacts-list-date float-right">2/28/2015</small>
                                                                              </span>
                                                                                           <span class="contacts-list-msg">How have you been? I was...</span>
                                                                                       </div>
                                                                                       <!-- /.contacts-list-info -->
                                                                                   </a>
                                                                               </li>
                                                                               <!-- End Contact Item -->
                                                                           </ul>
                                                                           <!-- /.contatcts-list -->
                                                                       </div>
                                                                       <!-- /.direct-chat-pane -->
                                                                   </div>
                                                                   <!-- /.card-body -->
                                                                   <div class="card-footer">
                                                                       <form action="#" method="post">
                                                                           <div class="input-group">
                                                                               <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                                                                               <span class="input-group-append">
                                                                  <button type="submit" class="btn btn-warning">Send</button>
                                                                </span>
                                                                           </div>
                                                                       </form>
                                                                   </div>
                                                                   <!-- /.card-footer-->
                                                               </div>
                                                               <!--/.direct-chat -->
                                                           </div>
                                                           <!-- /.card-body -->
                                                       </div>
                                                   </div>
                                                   <!-- /.card-body -->

                                               </div>
                                               <!-- /.friend-pane -->

                                               @if(auth()->id() === (int) request()->route('id'))
                                                    <div class="tab-pane" id="settings">
                                                   <h3>Заменить аватар</h3>
                                                   <form action="{{ route('customer.profile.media', $user->id) }}"
                                                         class="mb-4"
                                                         method="POST"
                                                         enctype="multipart/form-data">
                                                       @csrf
                                                       <input type="file" name="media" id="file" class="input-file" />
                                                       <button id="ava" type="submit" class="btn btn-warning float-right">Изменить</button>
                                                   </form>
                                                   <h3>Основная информация</h3>
                                                   <form action="{{ route('customer.profile.update', $user->id) }}" method="POST">
                                                       @csrf
                                                       @method('PATCH')
                                                       <div class="row">
                                                           <div class="col-6">
                                                               <div class="form-group">
                                                                   <label for="inputName">Имя</label>
                                                                   <input type="text" name="name" value="{{ $user->name }}" id="inputName" class="form-control">
                                                               </div>
                                                           </div>
                                                           <div class="col-6">
                                                               <div class="form-group">
                                                                   <label for="inputEmail">Email</label>
                                                                   <input type="email" name="email" id="inputEmail" value="{{ $user->email }}" class="form-control">
                                                               </div>
                                                           </div>
                                                       </div>
                                                       <div class="row">
                                                           <div class="col-6">
                                                               <div class="form-group">
                                                                   <label for="inputPhone">Телефон</label>
                                                                   <input type="text" name="phone" value="{{ $user->phone }}" id="inputPhone" class="form-control">
                                                               </div>
                                                           </div>
                                                           <div class="col-6">
                                                               @if(empty($user->birthday))
                                                                   <div class="form-group">
                                                                       <label for="inputDate">Дата рождения</label>
                                                                       <input type="date" name="birthday"
                                                                              id="inputDate"
                                                                              value="{{ $user->birthday }}"
                                                                              max="9999-12-31T23:59"
                                                                              class="form-control">
                                                                   </div>
                                                               @endif
                                                           </div>
                                                       </div>


                                                       <div class="row">
                                                           <div class="col-6">
                                                               <label for="inputStatus">Пол</label>
                                                               <select class="form-control"
                                                                       name="gender"
                                                                       id="inputGender">
                                                                   <option>Выбрать значение</option>
                                                                   <option value="1" @if($user->gender === 1) selected @endif>Муж</option>
                                                                   <option value="2" @if($user->gender === 2) selected @endif>Жен</option>
                                                               </select>
                                                           </div>

                                                           <div class="col">
                                                               <div class="form-group">
                                                                   <label>Адрес</label>
                                                                   <input
                                                                           class="form-control"
                                                                           id="ship-address"
                                                                           autocomplete="off"
                                                                           value="{{ $user->city }}"
                                                                   />
                                                               </div>
                                                           </div>
                                                           <input type="hidden" name="route" id="route">
                                                           <input type="hidden" name="street_number" id="street_number">
                                                           <input type="hidden" name="city" id="locality">
                                                           <input type="hidden" name="country" id="country">
                                                           <input type="hidden" name="states" id="administrative_area_level_1">
                                                       </div>

                                                       <div class="row">
                                                           <div class="col">
                                                               <div class="form-group">
                                                                   <label for="inputBio">Описание</label>
                                                                   <textarea name="bio" id="inputBio" class="form-control" rows="5">{{ $user->bio }}</textarea>
                                                               </div>
                                                           </div>
                                                       </div>

                                                       <div class="row">
                                                           <div class="col-6">
                                                               <!-- Name input -->
                                                               <div class="form-outline">
                                                                   <input type="password" class="form-control" id="password" name="password">
                                                                   <label class="form-label" for="form8Example4">Новый пароль</label>
                                                                   <div class="input-group-append">
                                                                       <button class="btn btn-secondary" type="button" onclick="showPassword()">Показать</button>
                                                                   </div>
                                                               </div>
                                                           </div>
                                                           <div class="col-6 mb-3 mt-3">
                                                               <!-- Email input -->
                                                               <div class="form-outline">
                                                                   <input type="password" name="password_confirmation" id="password_confirm" class="form-control" />
                                                                   <label class="form-label" for="form8Example5">Подтверждение пароля</label>
                                                                   <div class="input-group-append">
                                                                       <button class="btn btn-secondary" type="button" onclick="showPasswordConfirm()">Показать</button>
                                                                   </div>
                                                               </div>
                                                           </div>
                                                       </div>

                                                       <div class="form-group row">
                                                           <div class="offset-sm-2 col-sm-10">
                                                               <button type="submit" class="btn btn-warning float-right">Сохранить</button>
                                                           </div>
                                                       </div>
                                                   </form>
                                               </div>
                                               @endif
                                               <!-- /.tab-pane -->
                                           </div>
                                           <!-- /.tab-content -->
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
    <script src="{{ asset('js/show_pass.js') }}"></script>

    <script>

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
            let urlPost = window.location + '/' + el['id'];
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

        function ajaxLoaderFollower() {
            let pageNext = document.getElementById('pageFollow').value;
            let page = Number(pageNext) + 1;
            var id = window.location.href.split('/').pop();
            var url = "{{ route('customer.load.follower') }}" + "?page=" + page;

            $.ajax({
                type: 'GET',
                url: url,
                data: {id: id},
                success: function (data) {
                    console.log(data)
                    var followers = data.data;
                    if (data.pageOff == true) {
                        document.getElementById('btn2').style.display = 'none';
                    }

                    document.getElementById('pageFollow').value = data.page;
                    const element = document.createElement('div');
                    document.querySelector('#loadMoreFollowerUser').appendChild(element);

                    for (var i = 0; i < followers.length; i++) {
                        element.insertAdjacentHTML('beforebegin', followersDomElement(followers[i]));
                    }

                }
            });
        }

        function followersDomElement(el) {
            let urlPost = 'http://xn--m1aaxj.xn--90ais/profile/' + el['id'];

            return `
                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                    <div class="card bg-light d-flex flex-fill">
                        <div class="card-header text-muted border-bottom-0"></div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="lead"><b>${el['name']}</b></h2>
                                   <ul class="ml-4 mb-0 fa-ul text-muted">
                                       <li class="small"><span class="fa-li"><i class="fas fa-lg fa-home"></i></span> г. ${el['city'] != null ? el['city'] : ''}</li>
                                       <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> т.${el['phone']}</li>
                                   </ul>
                               </div>
                               <div class="col-5 text-center">
                                   <img src="${el['avatar']}" alt="user-avatar" class="img-circle img-fluid">
                               </div>
                           </div>
                       </div>
                       <div class="card-footer">
                           <div class="text-center">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox"
                                           name="ban"
                                           class="custom-control-input banned"
                                           id="customSwitch1"
                                           @if(1) checked @endif />
                                    <label class="custom-control-label" for="customSwitch1"> @if(1) Ban @else Unban @endif</label>
                                </div>
                                <a href="${urlPost}" class="btn btn-sm btn-primary">
                                   <i class="fas fa-user"></i> View Profile
                                </a>
                           </div>
                       </div>
                   </div>
               </div>`
        }



        checkboxes = Array.from(document.querySelectorAll('.banned'));
        checkboxes.forEach(function(checkbox, i) {

            checkbox.onchange = function() {

                $.ajax({
                    url: '{{ route('customer.subscription.ban', $user->id) }}',
                    type: 'POST',
                    data: {
                        settings: this.name,
                        id: this.value,
                        checked: this.checked ? 1:0
                    },
                    beforeSend: function() { checkbox.disabled = true; },
                    complete: function() { checkbox.disabled = false; },
                    success: function(response) {
                        console.log(response);
                    }
                });
            }
        });

    </script>
@endpush