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
						<div class="item vk"><div id='sharewallContainer'>script</div></div>
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
	<div class="news block">
		<div class="head wrap"><span>Новости</span></div>
		<div class="content wrap">
			<div class="content-list clear">
				@foreach($all_news as $news)
					<div class="item">
						<div class="content">
							<div class="image">
								@if($news->image == '')
									<div class="image"><img src="{!! web_url() !!}/uploads/small/default.png" alt="" width="340" height="127"></div>
								@else
									<div class="image"><img src="{!! web_url() !!}/uploads/small/{{ $news->image }}" alt="" width="340" height="127"></div>
								@endif
							</div>
							<div class="head"><a href="{{web_url()}}/news/{{$news->id}}"><span>{{ $news->title }}</span></a></div>
							<div class="text">
								<span>{{ $news->description }}</span>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
@stop