<div class="section-response__item section-response__item--{{ $item['class'] }}">
    <span class="section-response__item-round"></span>
    <p class="section-response__item-link tltp" title="{{ $item['url'] }}">{{ $item['url'] }}</p>
    <p title="{{ __('tools.server_response.http_code') }}" class="tltp section-response__item-code">
        <span class="section-response__item-code-num">{{ $item['httpCode'] }}</span>
        <span class="section-response__item-code-text">{{ $item['textHttpCode'] }}</span>
    </p>
    <p title="{{ __('tools.server_response.response_time') }}" class="tltp section-response__item-time">
        <span class="section-response__item-time-line section-response__item-time-line--{{ $item['info']['statusClass'] }}">
            {{ $item['time'] }} {{ __('app.sec') }}
        </span>
    </p>
    <span title="{{ __('tools.server_response.open_headers') }}" class="tltp section-response__item-trigger-response">
        <i class="mdi mdi-chevron-down"></i>
    </span>
    <div class="section-response__item-response">
        <p class="section-response__item-response-text">{{ $item['response'] }}</p>
    </div>
</div>
