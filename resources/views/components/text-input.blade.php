{{-- resources/views/components/text-input.blade.php --}}
@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'border-white/10 bg-gray-300 text-aurora-dark shadow-sm
                focus:border-aurora-vibrant focus:ring-aurora-vibrant
                rounded-md py-3 px-4 w-full transition-all duration-300
                placeholder-gray-700'
]) !!}>
