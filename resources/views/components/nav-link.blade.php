@props(['active'])

@php
    $classes = ($active ?? false)
                // Quando ATIVO: Fundo mais escuro (aurora-deep ou preto) e texto brilhante
                ? 'inline-flex items-center px-4 pt-1 border-b-2 border-aurora-vibrant bg-black/30 text-sm font-bold leading-5 text-white focus:outline-none transition duration-150 ease-in-out'

                // Quando INATIVO: Sem fundo e texto levemente transparente
                : 'inline-flex items-center px-4 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-white/70 hover:text-white hover:bg-white/5 focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
