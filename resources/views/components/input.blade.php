@props([
    'name',
    'class' => null,
    'label' => null,
    'type' => 'text'
])

<label class="block font-medium text-sm">
    @if ($label)
        <span>{{ $label }}</span>
    @endif

    <input {{ $attributes }} name="{{ $name }}" type="{{ $type }}" class="{{ $class ?? 'form-input mt-0.5 block w-full' }} @error($name) border-red-400 @enderror">
</label>
@error($name) <span class="block text-red-600 text-xs mt-0.5 font-medium">{{ $message }}</span> @enderror