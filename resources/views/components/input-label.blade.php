
<label {{ $attributes->merge(['class' => 'block font-bold text-sm text-aurora-deep mb-1']) }}>
    {{ $value ?? $slot }}
</label>
