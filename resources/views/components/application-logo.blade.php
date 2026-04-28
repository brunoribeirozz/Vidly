{{-- resources/views/components/application-logo.blade.php --}}
<svg {{ $attributes }} viewBox="0 0 256 256" xmlns="http://w3.org">
    <defs>
        <mask id="maskV">
            <rect width="100%" height="100%" fill="white" />
            <path d="M70 88 L112 188 L154 88 L136 88 L112 146 L88 88 Z" fill="black" />
        </mask>
    </defs>


    <path d="
        M44 12
        Q28 12 28 28
        L28 228
        Q28 244 44 244
        L228 144
        Q244 136 244 128
        Q244 120 228 112
        L44 12
        Z"
          fill="currentColor"
          mask="url(#maskV)"/>
</svg>
