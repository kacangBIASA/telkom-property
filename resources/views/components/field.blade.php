@props(['name', 'label', 'type' => 'text', 'value' => null, 'step' => null])
<div>
    <label class="mb-1 block text-sm font-medium" for="{{ $name }}">{{ $label }}</label>
    <input id="{{ $name }}" name="{{ $name }}" type="{{ $type }}" value="{{ old($name, $value) }}" @if($step) step="{{ $step }}" @endif class="inp">
    @error($name) <p class="err">{{ $message }}</p> @enderror
</div>
