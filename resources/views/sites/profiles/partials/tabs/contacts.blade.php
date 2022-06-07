<!-- /.profile-panel -->
<div class="active tab-pane" id="timeline">
    <!-- /.card-header -->
    <div class="card-body p-1">
        <div class="tab-pane" id="subscriber">
            @if($followers->count())
                <table class="table align-middle mb-0 bg-white">
                    <thead class="bg-light">
                    <tr>
                        <th>Имя</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($followers as $follower)
                        <tr style="@if($follower->pivot->banned) background-color: #f6f2e5 @endif">
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="{{ route('customer.profile.show', $follower->id) }}">
                                        <img
                                                src="@if($follower->media('media')->exists()) {{ $follower->getFirstMediaUrl('media') }}
                                                @else {{ asset('images/user/user-128.png') }}
                                                @endif"
                                                alt="ava"
                                                style="width: 50px; height: 50px"
                                                class="rounded-circle"
                                        />
                                    </a>
                                    <div class="ms-3">
                                        <p class="fw-bold mb-1">{{ $follower->name }}</p>
                                        <p class="text-muted mb-0">{{ $follower->city ?? '' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a class="btn btn-success btn-sm mb-1"
                                   href="#"
                                   role="button"><i class="fa fa-comment"></i> Чат</a>

                                <div class="custom-control custom-switch">
                                    <input type="checkbox"
                                           name="followId"
                                           value="{{ $follower->id }}"
                                           class="custom-control-input banned"
                                           id="customSwitch1"
                                    @if($follower->pivot->banned) checked @endif />
                                    <label class="custom-control-label" id="label-ban" for="customSwitch1">Бан</label>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-center m-1 ">
                    {{ $followers->links("pagination::bootstrap-4") }}
                </div>
            @else
                <h5 class="text-center pt-5">Подписок не найдено</h5>
            @endif

{{--                    <!-- Followers -->--}}
{{--                    <div id="loadMoreFollowerUser" class="p-1"></div>--}}
{{--                    <!-- /.followers -->--}}
{{--                    <div class="col-12 col-auto text-center loader__btn mt-5" id="loadMoreProfile">--}}
{{--                        <input type="hidden" id="pageFollow" value="0">--}}
{{--                        <button id="btn2" class="trigger btn" onclick="ajaxLoaderFollower()" style="opacity: 1;">Загрузить</button>--}}
{{--                    </div>--}}
        </div>
    </div>
    <!-- /.card-body -->

</div>
<!-- /.friend-pane -->