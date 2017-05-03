@extends('layouts.app')

@section('title', 'EadesMTG Products')

@section('content')
	
    <div class='content container text-left'>
    @if (session('status'))
            <div class="alert alert-success">
                <p> {{ session('status') }} </p>
            </div>
        @endif
        
	    <form class='form-horizontal text-center' method='post' action='{{ url("product/search") }}'>
	   	{{ csrf_field() }}
	   		<legend><h1 class='text-left'>Search Form</h1></legend>
	    	<div class="row col-sm-12">
	    		<div class="col-sm-6">
		    		@include('includes.search.defaultTerms')
		    	</div>
			    <div class="col-sm-6">
			    	@include('includes.search.accessoryTerms')
				    
				    @include('includes.search.cardTerms')
			    </div>
		    </div>
		    <div class='row col-sm-12'>
		    	<br>
		    	<input id='searchButton' class='btn btn-color col-sm-11' type="submit" value="Search"/>
		    </div>
	    </form>
	    @if(session('term'))
	    	@include('includes.results')
	    @else
	    	@include('includes.defaultSearch')
	    @endif
    </div>
@endsection