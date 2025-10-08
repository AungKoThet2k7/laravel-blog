<div {{ $attributes }}>
    <label class="form-label" for="{{ $name }}">{{ $label }}</label>
    <input @isset($form) form="{{ $form }}" @endisset
        name="{{ $multiple ? $name . '[]' : $name }}" id="{{ $name }}" value="{{ old($name, $default) }}"
        class="form-control @error($name) is-invalid @enderror @error("$name.*") is-invalid @enderror"
        type="{{ $type }}" @isset($multiple) multiple @endisset>
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    @isset($multiple)
        @error("$name.*")
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    @endisset
</div>
