@extends('layouts.layout')

@section('content')
	<div class="container">
		<div class="inner-container" id="particles-js">
			<div class="inner-container-left">
				<div class="explanation">
					Volg ons doorheen het land met onze Blow-a-Wish-box!
				</div>
			</div>
			<div class="inner-container-right">
				@foreach( $wishes as $wish )

				<div class="wish">
					<div class="quote-box">
						<div class="quote-text">
							<i class="fa fa-quote-left"></i><span id="text">{{ str_limit(ucfirst($wish->wish), 100) }}</span>
						</div>
						<div class="quote-author">
							- <span id="author">{{ ucfirst($wish->name) }}</span>
						</div>
					</div>
				</div>

				@endforeach
			</div>
		</div>
	</div>
@endsection