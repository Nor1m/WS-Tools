<div class="settings">
	<div class="col-xs-12 col-sm-12 col-md-12 settings__inner">
		<small class="settings__title">
			@if( isset( $title['text'] ) )
				{{ $title['text'] ?? '' }}
			@else
				Кол-во элементов: <b id="form-result__count">0</b>
			@endif
			
			@if( isset( $buttons['alert'] ) )
				<i class="mdi mdi-alert-circle-outline alert pop" 
				   data-tippy-content="{{ $buttons['alert'] ?? '' }}"></i>
			@endif
		</small>
		<div id="form-result" spellcheck="false" class="form-result settings__form-result settings__form-result--image">
			<img class="qr settings__form-result--qr" src="http://ws-tools.ru/tmp/qrcode/user1_5da9b5d3690cd.png">
		</div>
		<div class="ma-10"></div>
		<section class="w100 hide-buttons">

			@if( isset( $buttons ) ) 

				@if( isset( $buttons['file-load-button'] ) && $buttons['file-load-button'] )
					<button class="btn--green btn" id="file-load-button" onclick="$('a#file-load-button-hide')[0].click();"><i class="mdi mdi-download"></i>Скачать</button>
					<a download="#" id="file-load-button-hide" style="display:none" href="#">Скачать изображение</a>
				@endif

			@endif

		</section>
	</div>
</div>