@extends('admin.index')

<style>
    * { box-sizing: border-box; }
    .preview {
        width: 100%;
        display: block;
    }
    .preview li {
        display: block;
        list-item: none;
        width: 100px;
        height: auto;
        float: left;
        margin: 10px;
        transition: .1s;
    }
    .preview li.removing {
        opacity: 0;
        transform: scale(.2) translate(120%,-120%);
    }
    .preview img {
        max-width: 100px;
        max-height: 100px;
    }
    .preview a {
        position: absolute;
        z-index: 2;
        background: #abf6b9;
        color: #fff;
        font-size: 18pt;
        line-height: 12pt;
        text-decoration: none;
        border-radius: 50%;
        transform: translate(85px, 0px);
    }
    button {
        display: block;
        font-size: 16pt;
        clear: both;
    }
</style>

@section('content')
    <!-- Main content -->
    @include('_include.errors')
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
                                            <span class="red mr-1">*</span>
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
                                        <span class="red mr-1">*</span>
                                        <div id="mapReport" style="width: 100%; height: 450px"></div>
                                        <input type="hidden" name="lat" id="lat" value="">
                                        <input type="hidden" name="lng" id="lng" value="">
                                    </div>
                                </div>

                                <hr />

                                <!-- textarea -->
                                <div class="form-group">
                                    <label>Описание</label>
                                    <span class="red mr-1">*</span>
                                    <textarea class="form-control"
                                              rows="10"
                                              name="description"
                                              id="mytextarea"
                                              placeholder="Enter ...">{{ old('description') }}</textarea>
                                </div>


                                <div class="example-2 col-auto mb-4 d-flex align-item-center flex-column">
                                    <div class="row">
                                        <span class="red mr-1">*</span>
                                        <label>Загрузить фото:</label>
                                        <input type="file" id="fileMulti" name="media[gallery][]" multiple />
                                    </div>
                                    <div class="example-2 col-auto mb-4 d-flex" id="uploadMediaReport" style="justify-content: space-around;">
                                        <div class="form-group d-flex align-items-end">
                                            <ul class="preview"></ul>
                                        </div>
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

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.6/tinymce.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.6/jquery.tinymce.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/blsc8eepr9dcc6wd38p9f2s4aongqmhggoh2x2o2fkh6uu5y/tinymce/6/tinymce.min.js"></script>

    <script>
        $("#mytextarea").tinymce({
            selector: "#mytextarea",
            plugins: "emoticons autoresize",
            toolbar: "emoticons",
            toolbar_location: "bottom",
            menubar: false,
            statusbar: false
        })
    </script>
@endsection

@push('scripts')

    <!-- Google maps -->
    <script async
            src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_PLACE_KEY') }}&libraries=places&callback=initMap"
            defer></script>

    <script type="text/javascript" src="{{ asset('js/google-map_new-report.js') }}"></script>

    <script>
        $('div.alert.alert-danger').delay(8000).slideUp(300)

        // Сам <input>
        let  input = document.querySelector('input[type="file"]');
        // Блок предпросмотра
        const preview = document.querySelector('.preview');
        // Список файлов
        const fileList = [];

        // Обработчик кнопки Send
        // button.addEventListener('click', ()=>{
        //     if(!fileList.length){
        //         alert('Отправлять нечего');
        //         return;
        //     }
        //     //console.log(fileList);
        //
        //     // Отправлять мы ничего не будем, просто отобразим простой alert()
        //     alert(JSON.stringify(fileList.map(
        //         ({name,modified,size}) =>
        //             ({name,modified,size,data:'<[!FILEDATA]>'})
        //     ),null,2));
        // });

        // Вешаем функцию onChange на событие change у <input>
        input.addEventListener('change', onChange);

        function onChange () {
            // По каждому файлу <input>
            [...input.files].forEach(file=>{
                // Создаём читателя
                const reader = new FileReader;
                // Вешаем событие на читателя
                reader.addEventListener('loadend', ()=>{
                    // Элемент списка .preview
                    const item = document.createElement('li');
                    // Картинка для предпросмотра
                    const image = new Image;
                    // URI картинки
                    image.src = `data:${file.type};base64,${btoa(reader.result)}`;
                    // Ссылка на исключение картинки из списка выгрузки
                    const remove = document.createElement('a');
                    remove.innerHTML = '⊗';
                    // Элемент массива fileList
                    const fileItem = { name: file.name,
                        modified:file.lastModified,
                        size:file.size,
                        data: reader.result };
                    // Добавляем элемент в список выгрузки
                    fileList.push(fileItem);
                    // Обработчик клика по ссылке исключения картинки
                    remove.addEventListener('click',()=>{
                        // Исключаем элемент с картинкой из списка выгрузки
                        fileList.splice(fileList.indexOf(fileItem), 1);
                        // Удаляем элемент списка (<li>) из <ul>
                        item.classList.add('removing');
                        setTimeout(()=>item.remove(),100);
                    });
                    item.appendChild(remove);
                    item.appendChild(image);
                    preview.appendChild(item);
                });
                // Запускаем чтение файла
                reader.readAsBinaryString(file);
            });
            // Сбрасываем значение <input>
            // input.value = '';
            // Создаем клон <input>
            const newInput = input.cloneNode(true);
            // Заменяем <input> клоном
            input.replaceWith(newInput);
            // Теперь input будет указывать на клона
            input = newInput;
            // Повесим функцию onChange на событие change у нового <input>
            input.addEventListener('change', onChange);
        }
    </script>
@endpush