<div class="col-md-12" style="margin-top: 10px">
	@if (count($errors) > 0)
	<div class="alert alert-danger alert-styled-left alert-bordered">
		<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
		<span class="text-semibold">Oh snap!</span>
		<ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    
    @if (session('success'))
    <div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
		<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
		<span class="text-semibold">Well done!</span> {{ session('success') }}
    </div>
    @endif
    
    @if (session('warning'))
    <div class="alert alert-warning alert-styled-left">
		<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
		<span class="text-semibold">Warning!</span> {{ session('warning') }}
    </div>
    @endif

    @if (session('danger'))
    <div class="alert alert-danger alert-styled-left">
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
        <span class="text-semibold">Warning!</span> {{ session('danger') }}
    </div>
    @endif
</div>