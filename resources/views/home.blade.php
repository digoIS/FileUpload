@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- The fileinput-button span is used to style the file input field as button -->
                    <span class="btn btn-success fileinput-button">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>Selecione o arquivo...</span>
                        <!-- The file input field used as target for the file upload widget -->
                        <input id="fileupload" type="file" name="file" 
                            data-token="{!! csrf_token() !!}"
                            data-user-id="{!! Auth::user()->id !!}">
                    </span>
                    <br>
                    <br>
                    <!-- The global progress bar -->
                    <div id="progress" class="progress">
                        <div class="progress-bar progress-bar-success"></div>
                    </div>
                    <!-- The container for the uploaded files -->
                    <div id="files" class="files"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script>
    ;(function($){
        'use strict';
        $(document).ready(function()
        {
            var $fileupload = $('#fileupload');
            $fileupload.fileupload({
                url: 'laravel/public/upload',
                dataType: 'json',
                formData: {
                    _token: $fileupload.data('token'),
                    userid: $fileupload.data('userId'),
                    filename: $fileupload.data
                },
                done: function (e, data) {
                    $.each(data.result.files, function (index, file) {
                        $('<p/>').text(file.name).appendTo('#file');
                    });
                },
                progressall: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('#progress .progress-bar').css(
                        'width',
                        progress + '%'
                    );
                }
            });
        });        
    })(window.jQuery);
</script>
@endsection