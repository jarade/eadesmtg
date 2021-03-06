<nav id="top">
  <div class="container navContent">
   <div id="titlediv" class="nav">
      <ul id="mytoptitle"><li><i><a href="{{ url('/') }}" >EadesMTG</a><i></li></ul>
    </div>
    <div id="top-links" class="nav">
   
      <ul id="mytopnav">

        <li id="homelink" class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ url('/') }}" class="fa fa-home"><strong class="hiddenHeadings">Home</strong></a> </li>

        <li id="contactlink" class="{{ Request::is('contact') ? 'active' : '' }}"><a href="{{ url('contact') }}" class="fa fa-phone"><strong class="hiddenHeadings">Contact Us</strong></a> </li>

        <li id="searchlink" class="{{ Request::is('product') ? 'active' : '' }} {{ Request::is('product/search') ? 'active' : '' }}"><a href="{{url('product')}}" title="Search" class="fa fa-search"><strong class="hiddenHeadings">Search</strong></a></li>

        <li id="cartlink" class="{{ Request::is('cart') ? 'active' : '' }}"><a href="{{url('cart')}}" title="Shopping Cart" class="fa fa-shopping-cart"><strong class="hiddenHeadings">Shopping Cart</strong></a></li>
        
        @php 
            $taction = 'life';
        @endphp
        <li id="applink" class="{{ Request::is('life*') ? 'active' : '' }}"><a href="" onclick="lifeCounter('{{url($taction)}}')" class="fa fa-heart"><strong class="hiddenHeadings">Life Counter App</strong></a></li>
      </ul>
    </div>
  </div>
</nav>	