<div class="result">
	<div class="col-xs-12 col-sm-12 col-md-12 result__inner">
		<small class="result__title">
			@if( isset( $title['text'] ) )
				{{ $title['text'] ?? '' }}
				@if( isset( $title['tooltip'] ) )
					<i  class="mdi mdi-information-outline pop"
						data-tippy-content="{{ $title['tooltip'] ?? '' }}"></i>
				@endif
			@else
				Кол-во элементов: <b class="form-result__count" id="form-result__count">0</b>
			@endif

			@if( isset( $buttons['alert'] ) )
				<i class="mdi mdi-alert-circle-outline alert pop"
				   data-tippy-content="{{ $buttons['alert'] ?? '' }}"></i>
			@endif
		</small>

		<div id="form-result" style="{{ $style ?? '' }}"
			 contenteditable="true"
			 spellcheck="false"
			 class="result__form-result form-result {{ $class ?? '' }}"></div>

		<div class="ma-10"></div>

		<section class="result__buttons w100 hide-buttons">

			@if( isset( $buttons ) )

				@if( isset( $buttons['filter-button'] ) && $buttons['filter-button'] )
					<button class="btn--teal btn btn--icon" id="filter-button" onclick="filter('#form-result');"><i class="mdi mdi-filter-variant"></i>Фильтровать</button>
				@endif

				@if( isset( $buttons['clear-button'] ) && $buttons['clear-button'] )
					<button class="btn--red btn" id="clear-button" onclick="clear_list();"><i class="mdi mdi-file-document-box-remove-outline"></i>Очистить</button>
				@endif

				@if( isset( $buttons['copy-button'] ) && $buttons['copy-button'] )
					<button class="btn--blue btn" id="copy-button" data-clipboard-target="#form-result" onclick="copy();"><i class="mdi mdi-checkbox-multiple-blank-outline"></i>Скопировать</button>
				@endif

				@if( isset( $buttons['save-button'] ) && $buttons['save-button'] )
					<button class="btn--yellow btn" id="save-button"><i class="mdi mdi-star-outline"></i>Сохранить</button>
				@endif

				@if( isset( $buttons['file-load-button'] ) && $buttons['file-load-button'] )
					<button class="btn--green btn" id="file-load-button" onclick="setFile();"><i class="mdi mdi-download"></i>Скачать</button>
					<a download="#" id="file-load-button-hide" style="display:none" href="#">Скачать</a>
				@endif

			@endif

		</section>
	</div>
</div>
