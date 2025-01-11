{{-- T I T L E --}}

@if( isset( $title ) )

	<small>{{ $title['text'] ?? '' }}
		@if( isset( $title['tooltip'] ) )
			<i class="mdi mdi-information-outline pop" data-tippy-content="{{ $title['tooltip'] ?? '' }}"></i>
		@endif
	</small>
	@if( isset( $title['br'] ) ) <br> @endif

@endif


{{-- C H E C K B O X --}}

@if( isset( $checkbox ) )

	@foreach( $checkbox as $value => $data )

		<div class="checkbox-block">
			<input  class="checkbox"
					{{ $data['checked'] ?? '' }}
					type="checkbox"
					value="{{ $value ?? '' }}"
					id="{{ $data['id'] ?? $value }}"
					name="{{ $data['name'] ?? '' }}">
			<i class="mdi checkbox-i"></i>
			<label class="labeltop" for="{{ $data['id'] ?? $value }}"> {{ $data['text'] ?? '' }}
				@if( isset( $data['tooltip'] ) )
					<i class="mdi mdi-information-outline pop" data-tippy-content="{{ $data['tooltip'] ?? '' }}"></i>
				@endif
			</label>

			@if( isset( $data['box_input'] ) )

				<div class="checkbox-text-block">
					<div class="input-text-block {{ $data['box_input']['class'] ?? '' }}">

						@if( isset( $data['box_input']['desc'] ) )
							<small>{{ $data['box_input']['desc']['text'] ?? '' }}
								@if( isset( $data['box_input']['desc']['tooltip'] ) )
									<i class="mdi mdi-information-outline pop" data-tippy-content="{{ $data['box_input']['desc']['tooltip'] ?? '' }}"></i>
								@endif
							</small>
						@endif

						<input  id="{{ $data['box_input']['id'] ?? $data['box_input']['name'] }}"
								type="text"
								minlength="{{ $data['box_input']['minlength'] ?? '0' }}"
								maxlength="{{ $data['box_input']['maxlength'] ?? '1000' }}"
								value="{{ $data['box_input']['value'] ?? '' }}"
								class="{{ $data['box_input']['class-input'] ?? '' }}"
								name="{{ $data['box_input']['name'] ?? '' }}">

					</div>
				</div>

			@endif

		</div>

	@endforeach

@endif


{{-- R A D I O --}}

@if( isset( $radio ) )

	@foreach( $radio as $value => $data )

		<div class="radio-block">
			<input  class="radio"
					{{ $data['checked'] ?? '' }}
					type="radio"
					value="{{ $value ?? '' }}"
					id="{{ $data['id'] ?? $value }}"
					name="{{ $data['name'] ?? '' }}">
			<i class="mdi radio-i"></i>
			<label class="labeltop" for="{{ $data['id'] ?? $value }}"> {{ $data['text'] ?? '' }}
				@if( isset( $data['tooltip'] ) )
					<i class="mdi mdi-information-outline pop" data-tippy-content="{{ $data['tooltip'] ?? '' }}"></i>
				@endif
			</label>

			@if( isset( $data['box_input'] ) )

				<div class="radio-text-block">
					<div class="input-text-block {{ $data['box_input']['class'] ?? '' }}">

						@if( isset( $data['box_input']['desc'] ) )
							<small>{{ $data['box_input']['desc']['text'] ?? '' }}
								@if( isset( $data['box_input']['desc']['tooltip'] ) )
									<i class="mdi mdi-information-outline pop" data-tippy-content="{{ $data['box_input']['desc']['tooltip'] ?? '' }}"></i>
								@endif
							</small>
						@endif

						<input  id="{{ $data['box_input']['id'] ?? $data['box_input']['name'] }}"
								type="text"
								minlength="{{ $data['box_input']['minlength'] ?? '0' }}"
								maxlength="{{ $data['box_input']['maxlength'] ?? '1000' }}"
								value="{{ $data['box_input']['value'] ?? '' }}"
								class="{{ $data['box_input']['class-input'] ?? '' }}"
								name="{{ $data['box_input']['name'] ?? '' }}">

					</div>
				</div>

			@endif

		</div>

	@endforeach

@endif


{{-- N U M B E R --}}

@if( isset( $number ) )

	@foreach( $number as $data )

		<div class="input-number-block {{ $data['class'] ?? '' }}">

			@if( isset( $data['desc'] ) )
				<small>{{ $data['desc']['text'] ?? '' }}
					@if( isset( $data['desc']['tooltip'] ) )
						<i class="mdi mdi-information-outline pop" data-tippy-content="{{ $data['desc']['tooltip'] ?? '' }}"></i>
					@endif
				</small><br>
			@endif

			@if( isset( $data['before'] ) )
				<div class="before_input">{!! $data['before'] ?? '' !!}</div>
			@endif

			<input  id="{{ $data['id'] ?? $data['name'] }}"
					type="number"
					min="{{ $data['min'] ?? '1' }}"
					max="{{ $data['max'] ?? '100' }}"
					value="{{ $data['value'] ?? '' }}"
					class="{{ $data['class-input'] ?? '' }}"
					name="{{ $data['name'] ?? '' }}">
		</div>

	@endforeach

@endif


{{-- T E X T --}}

@if( isset( $text ) )

	@foreach( $text as $data )

		<div class="input-text-block {{ $data['class'] ?? '' }}">

			@if( isset( $data['desc'] ) )
				<small>{{ $data['desc']['text'] ?? '' }}
					@if( isset( $data['desc']['tooltip'] ) )
						<i class="mdi mdi-information-outline pop" data-tippy-content="{{ $data['desc']['tooltip'] ?? '' }}"></i>
					@endif
				</small><br>
			@endif

			@if( isset( $data['before'] ) )
				<div class="line-group line-group-before">
					<div class="before_input">{!! $data['before'] ?? '' !!}</div>
			@endif

			<input  id="{{ $data['id'] ?? $data['name'] }}"
					type="text"
					minlength="{{ $data['minlength'] ?? '0' }}"
					maxlength="{{ $data['maxlength'] ?? '1000' }}"
					value="{{ $data['value'] ?? '' }}"
					class="{{ $data['class-input'] ?? '' }}"
					name="{{ $data['name'] ?? '' }}">


			@if( isset( $data['before'] ) )
				</div>
			@endif

		</div>

	@endforeach

@endif
