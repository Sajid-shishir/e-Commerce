@if (Session::has('message'))
<div class="alert alert-success text-center">
 <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
 <p class="lead" style="color: rgb(14, 13, 13)">{{ Session::get('message') }}</p>
</div>
@endif
