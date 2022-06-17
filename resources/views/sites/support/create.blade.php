@extends('sites.layouts.main')

@section('content')

    <div class="content-box profile-page dashboard-content" id="dashboard">
        <div class="container  mt-5  px-lg-5">
            <ul id="docs-nav-pills" class="nav nav-pills mb-4" role="tablist">
                <li class="nav-item">
                    <a class="nav-link px-5 font-weight-bold">Заявка<i class="fas fa-external-link-alt ms-1"></i></a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade in show active" id="docsTabsOverview" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-10 col-md-12 p-2">
                            <!--Section: Docs content-->
                            @include('admin._include.errors')
                            <form action="{{ route('customer.support.store') }}" method="POST">
                            @csrf
                            <!-- Message input -->
                                <div class="form-outline mb-4">
                                    <textarea class="form-control" name="message" id="form4Example3" rows="5"></textarea>
                                    <label class="form-label" for="form4Example3">Сообщение</label>
                                </div>

                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary btn-block mb-4">Отправить</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $('div.alert.alert-danger').delay(4000).slideUp(300)
    </script>
@endpush