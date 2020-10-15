@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block text-center">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>{{ $message }}</strong>
    </div>


@elseif($message = Session::get('danger'))
<div class="alert alert-danger alert-block text-center">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>{{ $message }}</strong>
</div>
@endif
