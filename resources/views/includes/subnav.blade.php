<div class="subNav">
	<p id='sessionDetails'>Give these details to those who wish to join. Session Details: { Session ID - 
		@php
			if(isset($_SESSION['session'])){
				echo $_SESSION['session'];
				echo ' Password - ' . App\Session::find($_SESSION['session'])->password; 
			}
		@endphp
	} </p>
	<ul>
	
    	<li id='viewlink' class="{{ Request::is('life') ? 'active' : '' }} {{ Request::is('life/0') ? 'active' : '' }}"><a href="{{ url('life', [0]) }}"><strong>View</strong></a> </li>
    	<li id='editlink' class="{{ Request::is('life/1') ? 'active' : '' }}"><a href="{{ url('life', [1]) }}"><strong>Edit</strong></a> </li>
	</ul>
</div>