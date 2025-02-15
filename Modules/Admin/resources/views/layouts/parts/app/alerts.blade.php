    @if($errors->any())
    <div class="col-lg-12">
        @foreach($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            {{$error}}
        </div>
        @endforeach
    </div>
    @endif
    @if(session('success'))
    <div class="col-lg-12">
        <div class="alert alert-success" role="alert">
            {{session('success')}}
        </div>
    </div>
    @endif