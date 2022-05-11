@if ($notification = Session::get('success'))
<div class="alert alert-success" role="alert">
	<a type="button" class="close" data-dismiss="alert">×</a>	
        <strong>{{ $notification }}</strong>
</div>
@endif


@if ($notification = Session::get('error'))
<div class="alert alert-danger" role="alert">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $notification }}</strong>
</div>
@endif


@if ($notification = Session::get('warning'))
<div class="alert alert-warning alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
	<strong>{{ $notification }}</strong>
</div>
@endif


@if ($notification = Session::get('info'))
<div class="alert alert-info alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
	<strong>{{ $notification }}</strong>
</div>
@endif


@if ($errors->any())
<div class="alert alert-danger">
	<button type="button" class="close" data-dismiss="alert">×</button>	
	Please check the form under for errors
</div>
@endif