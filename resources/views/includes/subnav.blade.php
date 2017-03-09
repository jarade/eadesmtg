<div class="subNav">
  <ul>
    <li id='viewlink' class="{{ Request::is('life/0') ? 'active' : '' }}"><a href="{{ url('life', [0]) }}"><strong>View</strong></a> </li>
    <li id='editlink' class="{{ Request::is('life/1') ? 'active' : '' }}"><a href="{{ url('life', [1]) }}"><strong>Edit</strong></a> </li>
  </ul>
</div>