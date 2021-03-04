<div id="right-panel" class="right-panel">
@include('admin.header')
@if($view_name == 'admin-index')
@else
<h3 align="center" class="mt-3 pt-3">{{ Helper::translation(3216,$translate) }}</h3>
@endif
</div>