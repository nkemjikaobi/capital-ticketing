
@if (count($errors) > 0)
    @foreach ($errors->all as $error)
        <div class="alert alert-danger">
            {{$error}}
        </div>
    @endforeach

@endif

@if (session('success'))
    <div class='alert alert-success '>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong class=''>{{session('success')}}</strong>
    </div>
@endif

@if (session('error'))
    <div class='alert alert-danger'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong class=''>{{session('error')}}</strong>
    </div>

@endif
