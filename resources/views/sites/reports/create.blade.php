@extends('sites.layouts.main')

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

    @include('_include.errors')
    <div class="content-box profile-page dashboard-content" id="dashboard">
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

                                                <div class="form-group d-flex align-items-end">
                                                    <span class="red mr-1">*</span>
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
                                            <span class="red mr-1 d-flex">*</span>
                                            <div class="form-outline mb-4">
                                                <textarea class="form-control" name="description" id="mytextarea"></textarea>
                                            </div>

                                            <hr />
                                            <div class="form-outline mb-4 text-center">

                                                <h4 class="mb-3"><span class="red mr-1">*</span> Укажите место лова на карте</h4>

                                                <div id="mapReport" style="width: auto; height: 450px"></div>
                                                <input type="hidden" name="lat" id="lat" value="">
                                                <input type="hidden" name="lng" id="lng" value="">
                                            </div>

                                            <hr />
                                            <div class="example-2 col-auto mb-4 d-flex" id="uploadMediaReport" style="justify-content: space-around;">
                                                <div class="form-group d-flex align-items-end">
                                                    <span class="red mr-1">*</span>
                                                    <input type="file" accept="image/*" name="media[gallery][]" id="file" class="input-file" multiple />
                                                    <label for="file" class="btn btn-tertiary js-labelFile">
                                                        <i class="icon fa fa-check"></i>
                                                        <span class="js-fileName">Загрузить фото</span>
                                                    </label>
                                                </div>

                                                <div class="form-group d-flex align-items-end">
                                                    <input type="file" name="media[video][]" id="video" class="input-video" multiple />
                                                    <label for="video" class="btn btn-tertiary js-labelFile-video">
                                                        <i class="icon fa fa-check"></i>
                                                        <span class="js-fileName-video">Загрузить видео</span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="example-2 col-auto mb-4 d-flex" id="uploadMediaReport" style="justify-content: space-around;">
                                                <div class="form-group d-flex align-items-end">
                                                    <ul class="preview"></ul>
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
    <script type="text/javascript" src="{{ asset('js/report-media.js') }}"></script>


    <script>
        $('div.alert.alert-danger').delay(6000).slideUp(300)

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