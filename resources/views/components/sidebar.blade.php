@php
    $navItems = [
        [
            'label' => 'Daftar Pesanan',
            'route' => 'pesanan.index',
            'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>',
        ],
        [
            'label' => 'Daftar Pelanggan',
            'route' => 'pelanggan.index',
            'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m6-5a4 4 0 11-8 0 4 4 0 018 0zm6 2a3 3 0 11-6 0 3 3 0 016 0zM3 17a3 3 0 016 0" /></svg>',
        ],
        [
            'label' => 'Daftar Produk',
            'route' => 'produk.index',
            'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h7" /></svg>',
        ],
    ];
@endphp

<aside class="w-60 flex-shrink-0 bg-[#1B7080] flex flex-col h-full">

    {{-- Brand --}}
    <div class="px-6 pt-7 pb-6">
        <p class="text-white text-2xl font-bold tracking-wide">TOPLA</p>
        <p class="text-white/50 text-xs mt-0.5">Editorial Admin</p>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 px-3 space-y-0.5">
        @foreach ($navItems as $item)
            @php $active = request()->routeIs($item['route']); @endphp
            <a href="{{ route($item['route']) }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-150
                      {{ $active
                            ? 'bg-white/20 text-white shadow-sm'
                            : 'text-white/60 hover:bg-white/10 hover:text-white' }}">
                {!! $item['icon'] !!}
                {{ $item['label'] }}
            </a>
        @endforeach
    </nav>

    {{-- Logout --}}
    <div class="px-3 pb-6">
        <a href="#"
           class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-white/60 hover:bg-white/10 hover:text-white transition-all duration-150">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
            </svg>
            Keluar
        </a>
    </div>

</aside>
