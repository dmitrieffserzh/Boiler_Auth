<form>
    <div class="form-group row">
        <label for="colFormLabel" class="col-sm-2 col-form-label">URL профиля</label>
        <div class="col-sm-6">
            <input id="route" class="form-control ajax" type="text" name="route"
                   value="{{ $user->route ?? $user->username }}" placeholder="{{ $user->route ?? $user->username }}">
            <span class="valid-feedback" role="alert">Url свободен!</span>
            <span class="invalid-feedback" role="alert"></span>
            @if ($errors->has('username'))
                <span class="invalid-feedback" role="alert">{{ $errors->first('username') }}</span>
            @endif
        </div>
    </div>
</form>

@push('scripts')
    <script>
        let timer = null;
        $('#route').on('keyup', function () {
            let input = $(this);
            clearTimeout(timer);
            timer = setTimeout(function () {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: input,
                    type: 'POST',
                    url: '{{ route('check-route') }}',
                    success: function (result) {
                        let mainStat = (result.success) ? 'is-valid' : 'is-invalid';
                        let oldStat = (result.success) ? 'is-invalid' : 'is-valid';
                        let errorMes = result.error.join(' ') || '';
                        if (input.hasClass(oldStat))
                            input.removeClass(oldStat);
                        input.addClass(mainStat);
                        input.parent().find('.invalid-feedback').text(errorMes);
                    }
                });
            }, 500);
        });
        // $('.ajax').on('change', function (event) {
        //     alert('ff');
        //     console.log(this.value());
        //     event.preventDefault();
        //     // DATA
        //     let data_url = $(this).data('url');
        //     $.ajax({
        //         url: data_url,
        //         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        //         type: 'POST',
        //         success: function (data) {
        //             modal_window.find(modal_content).append(data.html);
        //         },
        //         complete: function () {
        //             modal_window.modal('show');
        //         }
        //     });
        // });
    </script>
@endpush