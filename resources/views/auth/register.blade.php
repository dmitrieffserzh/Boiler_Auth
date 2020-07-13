@extends('layouts.register')

@section('content')
    <h1 class="content-title">@lang('auth.register')</h1>
    @if (session('error_message'))
        <div class="alert alert-warning" role="alert">
            {{ session('error_message') }}
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group row">
            <label for="name"
                   class="col-md-4 col-form-label text-md-right col-form-label-sm">@lang('auth.register_username')</label>

            <div class="col-md-6">
                <input id="username" type="text"
                       class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                       name="username" value="{{ old('username') }}"
                       data-toggle="tooltip" data-placement="right" required autofocus>
                <span class="invalid-feedback" role="alert">{{ $errors->first('username') }}</span>
            </div>
        </div>

        <div class="form-group row">
            <label for="email"
                   class="col-md-4 col-form-label text-md-right col-form-label-sm">@lang('auth.register_email')</label>

            <div class="col-md-6">
                <input id="email" type="email"
                       class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                       name="email"
                       value="{{ old('email') }}" required>
                <span class="invalid-feedback" role="alert">{{ $errors->first('email') }}</span>
            </div>
        </div>

        <div class="form-group row">
            <label for="password"
                   class="col-md-4 col-form-label text-md-right col-form-label-sm">@lang('auth.register_password')</label>

            <div class="col-md-6">
                <input id="password" type="password"
                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                       name="password" required>

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">{{ $errors->first('password') }}</span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="password-confirm"
                   class="col-md-4 col-form-label text-md-right col-form-label-sm">@lang('auth.register_password_confirmation')</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control"
                       name="password_confirmation" required>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="button button-primary">
                    @lang('auth.register')
                </button>
            </div>
        </div>
    </form>
@endsection


@push('scripts')
    <script>
        let timer = null;
        $('#username').on('keyup', function () {
            let input = $(this);
            clearTimeout(timer);
            timer = setTimeout(function () {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: input,
                    type: 'POST',
                    url: '{{ route('check-name') }}',
                    success: function (result) {
                        let mainStat = (result.success) ? 'is-valid' : 'is-invalid';
                        let oldStat = (result.success) ? 'is-invalid' : 'is-valid';
                        let errorMes = result.error.join('<br>') || '';
                        if (input.hasClass(oldStat))
                            input.removeClass(oldStat);
                        input.addClass(mainStat);
                        input.parent().find('.invalid-feedback').html(errorMes);
                    }
                });
            }, 500);
        });
        $('#email').on('keyup', function () {
            let input = $(this);
            clearTimeout(timer);
            timer = setTimeout(function () {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: input,
                    type: 'POST',
                    url: '{{ route('check-email') }}',
                    success: function (result) {
                        let mainStat = (result.success) ? 'is-valid' : 'is-invalid';
                        let oldStat = (result.success) ? 'is-invalid' : 'is-valid';
                        let errorMes = result.error.join('<br>') || '';
                        if (input.hasClass(oldStat))
                            input.removeClass(oldStat);
                        input.addClass(mainStat);
                        input.parent().find('.invalid-feedback').html(errorMes);
                    }
                });
            }, 500);
        });
    </script>
@endpush






<!-- SLIDER -->
<div class="owl-carousel_main_slider">

    <?
    $first = true;
    foreach ($arResult as $item):

    $arFilter = Array("IBLOCK_ID" => $item['IBLOCK_ID'], "ID" => $item['ID']);
    $res = CIBlockElement::GetList(Array(), $arFilter);
    if ($ob = $res->GetNextElement()) {
        ;

        $arFields = $ob->GetFields(); // поля элемента
        $arProps = $ob->GetProperties(); // свойства элемента
        foreach ($arProps as $key => $value) {
            $prop[$key] = $value['VALUE'];
        }
    }

    // BG
    $image_bg = CFile::ResizeImageGet($prop["img"], array(), BX_RESIZE_IMAGE_EXACT, true);
    ?>
    <div>
    <div class="banner-left_img"
         style="background-image:linear-gradient( to bottom right, rgba(0, 0, 0, 0.79), rgba(26, 31, 53, 0.6)), url('<?= $image_bg['src']?>'); background-repeat: no-repeat;background-position: center center;">
    </div>
    <div class="main-slider__slide-container <? if ($first) {
        $first = false;
        echo "screen";
    } ?>">

        <div class="banner-title">
            <?= $item['NAME']?>
        </div>
        <div class="banner-subtitle">
            <?= $prop['content']['TEXT']?>
        </div>
        <a class="main-slider__slide-button" href="<?= $prop['link']?>">
            <?= $prop['text']?>
        </a>
    </div>
    </div>
    <?endforeach;?>

</div>