<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title"> <b><i class="fa {{$menu->icon}}"></i> {{ $menu->name }}</b> | {{ $menu->route }}</h4>
</div>
<div class="modal-body">
	<div class="row">
		<div class="col-md-12">
			<div class="well">
				<div class="row">
					<form id="add_submenu_form" data="{{ $menu->slug}}" autocomplete="off">
						@csrf
						<p class="page-header-sm text-center">Add submenu to {{ $menu->name }} </p>
						{!! __form::textbox(
				            '3 name', 'name', 'text', 'Name: *', 'Name','', '', '', ''
				        ) !!}



				        {!! __form::textbox(
				            '4 route', 'route', 'text', 'Route: *', $menu->route.'.example','', '', '', ''
				        ) !!}

				        {!! __form::textbox(
				            '3 nav_name', 'nav_name', 'text', 'Nav name:', 'Nav name','', '', '', ''
				        ) !!}

				        {!! __form::select_static(
							'2 is_nav', 'is_nav', 'Is nav: *', '', [
							'No' => '0',
							'Yes' => '1',
							], '', '', '', ''
			            ) !!}

			            <div class="col-md-12">
			            	<button type="submit" class="btn {!! __static::bg_color(Auth::user()->color) !!} pull-right">
				            	<i class="fa fa-save"></i> Save
				            </button>
			            </div>
		            </form>
				</div>
			</div>
		</div>

	</div>
	<hr>
	<center>
		<label>{{ $menu->name }} Submenus</label>
	</center>
	<div class="row">
		<div class="col-md-12">
			<table class="table table-striped table-bordered submenu_table" style="width: 100% !important">
				<thead>
					<tr class="{!! __static::bg_color(Auth::user()->color) !!}">
						<th>Name</th>
						<th>Route</th>
						<th>Nav name</th>
						<th>Nav</th>
						<th style="width: 70px !important">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($menu->submenu as $submenu)
					<tr id="{{ $submenu->slug }}">
						<td>{{ $submenu->name }}</td>
						<td>{{ $submenu->route }}</td>
						<td>{{ $submenu->nav_name }}</td>
						<td>
							@if($submenu->is_nav == 1)
								<center><span class="bg-green badge"><i class="fa fa-check"></i></span></center>
							@else
								<center><span class="bg-red badge"><i class="fa fa-times"></i></span></center>
							@endif
						</td>
						<td>
						  <div class="btn-group">
			                  <button data="{{$submenu->slug}}" class="btn btn-sm btn-default edit_submenu_btn">
			                    <i class="fa fa-pencil-square-o"></i>
			                  </button>
			                  <button data="{{$submenu->slug}}" class="btn btn-sm btn-danger delete_submenu_btn">
			                    <i class="fa  fa-trash-o"></i>
			                  </button>
			                </div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="modal-footer">
	<div class="row">
		{!! __html::timestamp($menu ,"4") !!}
	    <div class="col-md-4">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>

	</div>

</div>