{{-- Mude a cor para o seu aurora-light ou branco --}}
<label {{ $attributes->merge(['class' => 'block font-bold text-sm text-aurora-deep mb-1']) }}>
    {{ $value ?? $slot }}
</label>
