@props([
    'name' => '',
    'label' => '',
    'value' => '',
    'required' => false,
    'rows' => 6,
])
<div class="mb-4">
    <label for="{{ $name }}" class="block text-gray-600 font-bold mb-2">{{ $label }}</label>
    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        rows="{{ $rows }}"
        {{ $required ? 'required' : '' }}
        class="w-full py-2 px-3 rounded bg-w-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 border border-blue-500/30"
    >{{ old($name, $value) }}</textarea>
    @error($name)
        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
    @enderror
</div>
