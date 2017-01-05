@extends('layouts.layout')

@section('content')

<div class="container">
	<div class="inner-container" id="particles-js">
		@foreach($wishes as $wish)
		<div class="card">
			<div class="card_handle"></div>
			<div class="card_text">
				<div class="quote-box">
					<div class="quote-text">
						<i class="fa fa-quote-left"></i><span id="text">{{ str_limit(ucfirst($wish->wish), 100) }}</span>
					</div>
					<div class="quote-author">
						- <span id="author">{{ ucfirst($wish->name) }}</span>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>
	<div class="pagination">
		{{ $wishes->links() }}
	</div>
</div>
@endsection