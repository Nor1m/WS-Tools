<div class="section-response__info">
    <p class="section-response__info-title">
        {{ __('tools.server_response.general_response_time') }}:
        <span class="section-response__time section-response__time--{{ $statusClass }}">
            {{ $totalTime }} {{ __('tools.sec') }} ({{ $statusText }})
        </span>
    </p>
</div>

@if($primaryIp || $localIp)
    <div class="section-response__info-ips">
        @if($primaryIp)
            <p class="section-response__info-ip">{{ __('tools.server_response.server_ip') }}: <b>{{ $primaryIp }}</b></p>
        @endif
        @if($localIp)
            <p class="section-response__info-ip">{{ __('tools.server_response.local_ip') }}: <b>{{ $localIp }}</b></p>
        @endif
    </div>
@endif

<div class="section-response__items-block">
    <p class="section-response__items-block-title">{{ __('tools.server_response.response_code') }}:</p>
    <div class="section-response__items">
        @foreach($items ?? [] as $item)
            @include('panel.tools.server.parts.server-response-item')
        @endforeach
    </div>
</div>
