<small>{{ $link['text'] ?? 'Ссылки' }}
    @if( isset( $link['tooltip'] ) )
        <i class="mdi mdi-information-outline pop"
           data-tippy-content="{{ $link['tooltip'] ?? '' }}"></i>
    @endif
</small>
<br>
<textarea spellcheck="false"
          style="{{ $link['style'] ?? '' }}"
          class="{{ $link['class'] ?? 'tags_textarea' }}"
          maxlength="{{ $link['maxlength'] ?? '100000' }}"
          name="{{ $link['name'] ?? $link['id'] }}"
          placeholder="{{ $link['placeholder'] ?? '' }}"
          id="{{ $link['id'] ?? 'link' }}">{{ $link['value'] ?? '' }}</textarea>
