@extends('layout')
@section('content')

	<div class="page wrapper news">
		<div class="content wrap">
			<div class="head">
				<div class="image"><img src="{!! web_url() !!}/uploads/big/{{ $news->image }}" alt=""></div>
				<div class="title">
					<h1>{{$news->title}}</h1>
					<div class="category"><a href=""><span>Статьи</span></a></div>
				</div>
				<div class="share">
					<div class="content-list clear">
						<div class="item vk"><a href=""><span><i class="fa fa-fw fa-vk"></i></span></a></div>
						<div class="item ok"><a href=""><span><i class="fa fa-odnoklassniki"></i></span></a></div>
						<div class="item fb"><a href=""><span><i class="fa fa-facebook"></i></span></a></div>
						<div class="item tw"><a href=""><span><i class="fa fa-twitter"></i></span></a></div>
						<div class="item gg"><a href=""><span><i class="fa fa-google-plus"></i></span></a></div>
					</div>
				</div>
			</div>
			<div class="text">
				<p style="text-align: justify;">{{$news->description}}</p>

			</div>
		</div>
	</div>
@stop