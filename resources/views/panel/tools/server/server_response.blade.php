@extends('layouts.panel')

@section('content')

    <section class="wrapper__content" id="wrapper__content">

        <div class="container">

            <div class="wrapper_tool">

                <div class="row">

                    @include('panel.partials.blocks.title')

                    <section class="col-xs-12 col-sm-12 col-md-4">
                        <div class="settings">
                            <div class="row">

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    @include('panel.partials.fields.link', [
                                        'link' => [
                                            'text' => __('panel.input.url'),
                                            'id' => 'link',
                                            'placeholder' => __('panel.input.url_example'),
                                            'name' => 'url',
                                        ]
                                    ])
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <button class="btn--black btn btn--icon btn--full" id="start-parse"
                                            onclick="startTool(); return false;"><i
                                                class="mdi mdi-play"></i>{{ __('panel.input.run') }}
                                    </button>
                                </div>

                            </div>
                        </div>
                    </section>

                    <section class="col-sm-7 section-response result" style="display: none">
                        <div class="section-response__inner result__inner">
                            <div class="col-sm-12">
                                <div id="form-result"></div>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function () {
            toolInit();
        });

        function toolInit() {
            let $el = $('#link');
            $el.tagEditor({
                delimiter: ', \n',
                placeholder: $el.attr('placeholder'),
                animateDelete: 0,
                sortable: false,
                maxTags: 1
            });
        }

        function startTool() {

            let url = $('#link').val();

            if (!url) {

                msg('Внимание', 'Нет ссылки', 'warning', 'Хорошо');

            } else {

                ajaxData({
                    'method': 'get',
                    'url': '/tools/run/server-response',
                    'data': {
                        url: url,
                    },
                });

            }
        }
    </script>

@endsection
