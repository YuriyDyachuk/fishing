@extends('admin.index')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-2 mt-3">
                </div>
                <div class="col-12">
                    <div class="card mt-3">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="col d-flex">
                                    <div class="form-group col-4">
                                        <div class="form-group">
                                            <label>Роль</label>
                                            <select class="form-control" name="role">
                                                <option value="1"
                                                        @if($user->role == 1) selected @endif>
                                                    ADMIN
                                                </option>
                                                <option value="2"
                                                        @if($user->role == 2) selected @endif>
                                                    MODERATOR
                                                </option>
                                                <option value="3"
                                                        @if($user->role == 3) selected @endif>
                                                    CUSTOMER
                                                </option>
                                            </select>
                                        </div>

                                        <div class="custom-control custom-switch">
                                            <input type="checkbox"
                                                   name="ban"
                                                   class="custom-control-input"
                                                   id="customSwitch1"
                                                   @if($user->ban) checked @endif />
                                            <label class="custom-control-label" for="customSwitch1"> @if($user->ban) Unban @else Ban @endif</label>
                                        </div>
                                    </div>

                                </div>

                                <hr />

                                <button type="submit" class="btn btn-warning">Применить</button>
                            </form>
                        </div>
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
@endsection