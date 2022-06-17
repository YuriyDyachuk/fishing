@extends('admin.index')

@section('content')

    <section class="content mt-2">
        <div class="container-fluid">
            @include('admin._include.errors')
            <div class="form-outline mb-4">
                <textarea class="form-control" id="form4Example3" rows="4">{{ $support->message }}</textarea>
            </div>

            <form action="{{ route('supports.update', $support->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <!-- Message input -->
                <!-- Checkbox -->
                <div class="form-check d-flex justify-content-center mb-4">
                    <input type="checkbox"
                           name="status"
                           class="custom-control-input"
                           id="customSwitch1"
                           @if($support->status) checked @endif />
                    <label class="custom-control-label" for="customSwitch1"> @if($support->status) Обработать заявку @else Заявка на модерации @endif  </label>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4">Обработать</button>
            </form>
        </div>
    </section>

@endsection

@push('scripts')
    <script>
        $('div.alert.alert-success').delay(3000).slideUp(300)
        $('div.alert.alert-danger').delay(4000).slideUp(300)
    </script>
@endpush