@include('panel.partials.fields.formGenerator', [
	'title'    => [
		'text' => 'Формат выдачи:',
	],
	'radio' => [
		'id' => [
			'checked' => 'checked',
			'name'    => 'format',
			'id'      => 'num_format',
			'tooltip' => 'Пример:<br>164637621',
			'text'    => 'ID',
		],
		'link' => [
			'name'    => 'format',
			'id'      => 'link_format',
			'tooltip' => 'Пример:<br>vk.com/wstools',
			'text'    => 'Ссылка',
		],
	],
])