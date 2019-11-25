<div class="row">

    @if(Session::has('success'))

    <br>

    <div class="alert alert-success alert-dismissible show" role="alert">
        <strong>Success!</strong> {{ Session::get('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    @endif



    @if(Session::has('error'))

    <br>

    <div class="alert alert-danger alert-dismissible show" role="alert">
        <strong>Error!</strong> {{ Session::get('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    @endif

</div>