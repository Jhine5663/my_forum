@props([
    'type' => 'submit',
    'label' => 'Submit',
])
<button
    type="{{ $type }}"
    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded pixel-btn"
>
    {{ $label }}
</button>