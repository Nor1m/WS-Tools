<div class="sidebar_small" id="sidebar_small">
	
	<div class="sidebar_small__inner">
		
		<div class="sidebar_small__logo">
			<a class="sidebar_small__logo-link" href="/">
				<img class="sidebar_small__logo-img" src="{{ asset('images/logo.png') }}" alt="logo">
			</a>
		</div>

		<ul class="sidebar_small__menu">
			<li class="sidebar_small__menu-item">
				<a href="#" class="sidebar_small__menu-item-link">
					<i class="mdi mdi-view-grid"></i>
				</a>
			</li>
			<li class="sidebar_small__menu-item" data-trigger="big-menu">
				<a href="javascript:toggle_big_menu();" class="sidebar_small__menu-item-link">
					<i class="mdi mdi-tools"></i>
				</a>
			</li>
			<li class="sidebar_small__menu-item">
				<a href="#" class="sidebar_small__menu-item-link">
					<i class="mdi mdi-palette"></i>
				</a>
			</li>
			<li class="sidebar_small__menu-item">
				<a href="#" class="sidebar_small__menu-item-link">
					<i class="mdi mdi-lifebuoy"></i>
				</a>
			</li>
			<li class="sidebar_small__menu-item">
				<a href="#" class="sidebar_small__menu-item-link">
					<i class="mdi mdi-settings"></i>
				</a>
			</li>
			<li class="sidebar_small__menu-item">
				<a href="#" class="sidebar_small__menu-item-link">
					<i class="mdi mdi-diamond-stone"></i>
				</a>
			</li>
		</ul>

	</div>

</div>

<div class="sidebar_big" id="sidebar_big">

	<div class="sidebar_big__inner">
		
		<div class="sidebar_big__search-block">
			<div class="sidebar_big__search-block-inner">
				<div class="sidebar_big__search-block-icon">
					<i class="mdi mdi-magnify"></i>
				</div>
				<input class="sidebar_big__search-block-input" type="text" name="search" autocomplete="off"
					   placeholder="{{ __('panel.input.search_for_tools') }}" id="search">
			</div>
		</div>

		<div class="sidebar_big__blocks">

			@if( $menu['other']??null )
				<div class="sidebar_big__block">
					<p class="sidebar_big__block-title">{{ __('panel.category.other') }}</p>
					<ul class="sidebar_big__block-menu">
						@foreach( $menu['other'] as $id => $data )
							<li class="sidebar_big__block-menu-item">
								<a class="sidebar_big__block-menu-item-link @if($data['is_active']){{'active'}}@endif"
								   href="{{ route('tools.show.'.$id) }}">
									@if( isset($data['icon']) )
										<i class="{{ $data['icon'] }}"></i>
									@endif
									<span>{{ __($data['title']) }}</span>
								</a>
							</li>
						@endforeach
					</ul>
				</div>
			@endif

		</div>

	</div>
	
</div>