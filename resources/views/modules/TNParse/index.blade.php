@extends('layouts.default')

@section('title')Logistam.RU
@endsection

@section('description')
    Сервисы помощи логистам.
@endsection

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <br>
        <br>
        <br>
        <br>
        <br>
        <form id="search" action="{{ route('search') }}" enctype="multipart/form-data">
            <div class="form-group">
                <input type="text" id="search_input" name="search" class="form-control">
                <input type="submit">
            </div>
        </form>
        <div id="rrres"></div>

        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
<!--

        <div class="mt-5 p-3 bg-light border border-primary rounded">
            <form id="import-form" method="POST" action="{{ route('modules.TNParse.upload') }}"
                  enctype="multipart/form-data">
                @csrf
                <div class="progress" style="height: 30px;">
                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0"
                         aria-valuemax="100"></div>
                </div>
                <br>
                <div class="form-group">
                    <label for="input-file">Выберите ZIP-файл</label>
                    <input type="file" name="file" accept=".zip" class="form-control-file" id="input-file">
                </div>
                <button type="submit" class="btn btn-primary disabled" id="button-submit">
                    Импорт
                </button>
            </form>
        </div>

        <div id="result" class="alert alert-primary mt-2 d-none" role="alert"></div>
-->

    </div>
@endsection



@push('scripts')
    <script>

        let timer = null;
        $('#search_input').on('keyup', function () {
            let input = $(this);
            clearTimeout(timer);
            timer = setTimeout(function () {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: input,
                    type: 'POST',
                    url: '{{ route('search') }}',
                    success: function (result) {
                        //$('#rrres').html(result);

                        $.each(JSON.parse(result), function (index, value) {
                            $('#rrres').append('<p style="border: 1px Solid #f5f5f8;">'+value.name+'</p>');
                            console.log(value);
                        });
                    }
                });
            }, 500);
        });


        /*
        $(function () {
            $('form#import-form').on('change', function () {
                let inputFile = $('input[type=file]')[0].files[0];
                let btnSubmit = $('#button-submit');
                if (!inputFile) {
                    btnSubmit.addClass('disabled');
                } else {
                    btnSubmit.removeClass('disabled');
                }
            });
            $('form#import-form').submit(function (e) {
                e.preventDefault();
                $('#result').addClass('d-none');
                $('.progress-bar').css('width', 0 + "%");
                if (!$('#button-submit').hasClass('disabled')) {
                    e.stopImmediatePropagation();
                    let formData = new FormData($(this)[0]);
                    let file = $('input[type=file]')[0].files[0];
                    formData.append('upload_file', file);
                    $('.progress').show();
                    $.ajax({
                        xhr: function () {
                            let xhr = new window.XMLHttpRequest();
                            xhr.upload.addEventListener("progress", function (evt) {
                                if (evt.lengthComputable) {
                                    let percentComplete = evt.loaded / evt.total;
                                    percentComplete = parseInt(percentComplete * 100);
                                    $('.progress-bar').css('width', percentComplete + "%");
                                    $('.progress-bar').html(percentComplete + "%");
                                    if (percentComplete === 100) {
                                    }
                                }
                            }, false);
                            return xhr;
                        },
                        type: 'POST',
                        url: '{{ route('modules.TNParse.upload') }}',
                        data: formData,
                        async: true,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (returndata) {
                            console.log(returndata);
                            $('#result').removeClass('d-none').html(returndata);
                        }
                    });
                    return false;
                }
            });
        });
        */
    </script>
@endpush