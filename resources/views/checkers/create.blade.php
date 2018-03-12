<div class="card">
    <div class="card-header">Create a checker</div>

    <div class="card-body">
        <form method="POST" action="{{ route('checker.create') }}">
            @csrf

            <div class="form-group row">
                <label for="url" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                <div class="col-md-6">
                    <input id="url" type="url" class="form-control{{ $errors->has('url') ? ' is-invalid' : '' }}" name="url" value="{{ old('url') }}" required autofocus placeholder="https://example.com">

                    @if ($errors->has('url'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('url') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        Subscribe
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
