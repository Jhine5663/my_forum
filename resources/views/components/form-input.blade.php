@props([
    'name' => '',
    'label' => '',
    'type' => 'text',
    'value' => '',
    'required' => false,
])
<div class="mb-4">
    <label for="{{ $name }}" class="block text-gray-300 font-bold mb-2">{{ $label }}</label>
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name, $value) }}"
        {{ $required ? 'required' : '' }}
        class="w-full py-2 px-3 rounded bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 border border-blue-500/30"
    >
    @error($name)
        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
    @enderror
</div>