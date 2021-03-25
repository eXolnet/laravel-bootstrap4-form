<div {!! Html::attributes($attributes ?? []) !!}>
    @if (!isset($labelLocation) || $labelLocation === \Exolnet\LaravelBootstrap4Form\Support\FormGroupBuilder::LABEL_LOCATION_BEFORE)
        {{ $label }}
    @endif

    @if (isset($tooltip))
        <span class="d-inline-block d-print-none" tabindex="-1" data-toggle="tooltip" title="{{ $tooltip }}">@svg('info-circle')</span>
    @endif

    <div class="form-group__input">
        {{ $input ?? '' }}

        @if (isset($labelLocation) && in_array($labelLocation, [\Exolnet\LaravelBootstrap4Form\Support\FormGroupBuilder::LABEL_LOCATION_BESIDE, \Exolnet\LaravelBootstrap4Form\Support\FormGroupBuilder::LABEL_LOCATION_BESIDE_ONLY]))
            {{ $label }}
        @endif

        @if (isset($name) && isset($errors) && $errors->has(\Exolnet\LaravelBootstrap4Form\Support\Helper::stringArrayToDotNotation($name)))
            <span class="invalid-feedback">
                <strong>{{ $errors->first(\Exolnet\LaravelBootstrap4Form\Support\Helper::stringArrayToDotNotation($name)) }}</strong>
            </span>
        @endif
    </div>
</div>
