@if (Session::has('message'))
<div class="alert alert-success text-center">
 <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
 <p class="lead" style="color: rgb(14, 13, 13)">{{ Session::get('message') }}</p>
</div>
@elseif(Session::has('error'))
<div class="alert alert-danger text-center">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <p class="lead" style="color: rgb(73, 69, 69)">{{ Session::get('error') }}</p>
   </div>
@endif
