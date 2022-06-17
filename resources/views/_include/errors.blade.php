@if($errors->any())
    <div class="alert alert-danger m-2 container">
        <p><strong>Ой! Что-то пошло не так.</strong></p>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success alert-dismissible mt-1 container" style="position: relative;top: 90px;height: 50px;">
        <h6><i class="icon fas fa-check"></i> {{session('success')}}</h6>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible mt-1 container" style="position: relative;top: 90px;height: 50px;">
        <h6><i class="icon fas fa-ban"></i> {{session('error')}}</h6>
    </div>
@endif