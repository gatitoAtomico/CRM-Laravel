@extends('layouts.master')

@section('title', 'Profile Page')

@section('sidebar')
    @parent
@stop

@section('content')

    <div id="content">
        <div class="row">
            <div class="col-md-6">

                <div class="card bg-dark text-white">
                    <div class="card-header">
                        User Avatar
                    </div>
                    <div class="card-body">
                        <img class="avatar" src="{{ asset('storage/user-avatar') }}/{{$avatar}}"
                             class="img-responsive"/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card bg-light text-dark">
                    <div class="card-header">
                        Change Avatar
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('profile.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="file" name="avatar"
                                       class="form-control{{ $errors->has('file') ? ' is-invalid' : '' }}">
                                @if ($errors->has('file'))
                                    <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('file') }}</strong>
              </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Change Avatar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-center">
            <div id="profileCard" class="card bg-secondary text-white">
                <div class="card-body">Update Profile</div>

                <form action="{{url('profile', [$user->id])}}" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    {{ csrf_field() }}
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Name accepts only characters</label>
                            <input type="text" value="{{$user->first_name}}" class="form-control" id="name" name="name"
                                   required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Last Name accepts only characters</label>
                            <input type="text" value="{{$user->last_name}}" class="form-control" id="lastName"
                                   name="lastName"
                                   required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Email</label>
                        <input type="email" class="form-control" value="{{$user->email}}" id="value" name="email"
                               required>
                    </div>
                    <a href="javascript:update({{$user->id}});" class="btn btn-primary">Update</a>
                </form>


            </div>
        </div>
    </div>


    @if(Session::has('error') or $errors->any())
        <script>$('#errorModal').modal('toggle');</script>
    @endif


    @if(!empty($message))
        <script>$('#infoModal').modal('toggle');</script>
    @endif

@stop

<script>

    function update(id) {
        //remove previous errors every time function is called
        $("#errors").empty();
        const name = $("input[name=name]").val();
        const lastName = $("input[name=lastName]").val();
        const email = $("input[name=email]").val();

        $.ajax({
            type: 'PUT',
            url: '{{ route('profile.update', '') }}/' + id,
            data: {_token: '{{ csrf_token() }}', name: name, lastName: lastName, email: email},
            success: function (response) {
                $('#message').addClass("alert alert-info").text(response['message']);
                $('#infoModal').modal('show');

            },
            error: function (xhr, status, error) {
                $.each(xhr.responseJSON.errors, function (key, item) {
                    $("#errors").append("<li class='alert alert-danger'>" + item + "</li>")
                    $('#errorModal').modal('show');

                });

            }

        });
    }


</script>



