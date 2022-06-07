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

            <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn btn-warning float-right">Сохранить</button>
                </div>
            </div>
        </form>
    </div>
@endif