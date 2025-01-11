<small>{{ $ace['text'] ?? 'Ссылки' }}
	@if( isset( $ace['tooltip'] ) )
		<i  class="mdi mdi-information-outline pop"
			data-tippy-content="{{ $ace['tooltip'] ?? '' }}"></i>
	@endif
</small>
<br>
<div style="{{ $ace['style'] ?? '' }}"
	 name="{{ $ace['name'] ?? '' }}"
	 class="form-result ace_nor1m"
	 ace_type="{{ $ace['ace_type'] ?? '' }}"
	 id="{{ $ace['id'] ?? 'ace_frmaout' }}"></div>
