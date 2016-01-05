@extends('admin.layout')
@section('content')



		<div class="wrap">
			<div class="header">
				<div class="clear">
					<div class="title"><span>{sectionName}</span></div>
					<div class="controls">
						<div class="btn-group">{controls}</div>
					</div>
				</div>
			</div>
			<div class="content {pagetag}">
				<div class="clear">
					{content}
				</div>
			</div>
		</div>

@stop