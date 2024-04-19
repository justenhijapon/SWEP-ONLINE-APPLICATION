<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">Reorder Menus</h4>
</div>
<div class="modal-body">
	<p class="text-primary">Drag the <i class="fa fa-arrows"></i> icon to rearrange.</p>
	<ol id="sort_menus" class="sortable todo-list">
		@php
			$menus = $menus->sortBy('order');	
		@endphp

		@foreach($menus as $menu)
			@if($menu->is_menu != 0)
				<li data="{{$menu->slug}}">
			      <span class="handle ui-sortable-handle">
			            <i class="fa fa-arrows"></i>
			       </span>
			      <span class="text">{{$menu->name}}</span>
			    </li>
		    @endif
	    @endforeach
	</ol>


</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

	<button type="button" class="btn btn-primary submit_reorder_btn"> <i class="fa fa-save"></i> Save</button>
</div>

<script>
	$(".sortable").sortable();
</script>

