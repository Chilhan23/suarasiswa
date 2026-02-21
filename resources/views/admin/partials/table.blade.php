{{-- resources/views/admin/partials/table.blade.php --}}
{{-- Dipanggil dengan $data (collection) dan $emptyMsg --}}

@if($data->isEmpty())
<div class="flex flex-col items-center justify-center py-20 text-center">
    <div class="w-20 h-20 bg-slate-100 rounded-3xl flex items-center justify-center text-4xl text-slate-300 mb-5">
        <i class="bi bi-inbox"></i>
    </div>
    <p class="font-black text-slate-400 text-lg">{{ $emptyMsg }}</p>
    <p class="text-slate-300 text-sm mt-1 font-medium">Belum ada data yang perlu ditampilkan.</p>
</div>
@else
<div class="space-y-4">
    @foreach($data as $item)
    <div class="bg-white border border-slate-200 rounded-[2rem] p-6 hover:border-blue-200 hover:shadow-md transition-all group">
        <div class="flex flex-col md:flex-row md:items-start gap-4">

            {{-- Avatar Inisial --}}
            <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-black text-sm shrink-0 shadow-lg shadow-blue-100">
                {{ strtoupper(substr($item->user->name ?? 'U', 0, 1)) }}
            </div>

            {{-- Konten --}}
            <div class="flex-1 min-w-0">
                <div class="flex flex-wrap items-center gap-2 mb-1">
                    <span class="font-black text-slate-800 text-sm">{{ $item->user->nis ?? 'Anonim' }}</span>
                    <span class="text-slate-300">·</span>
                    <span class="text-xs text-slate-400 font-medium">{{ $item->created_at->diffForHumans() }}</span>

                    {{-- Badge Kategori --}}
                    @if($item->category)
                    <span class="text-[10px] font-black px-2.5 py-0.5 rounded-full bg-blue-50 text-blue-600 border border-blue-100">
                        {{ $item->category->name }}
                    </span>
                    @endif

                    {{-- Badge Status --}}
                    @php
                        $statusConfig = [
                            'pending' => ['bg-amber-50 text-amber-600 border-amber-200', 'bi-clock-fill', 'Pending'],
                            'proses'  => ['bg-sky-50 text-sky-600 border-sky-200', 'bi-hourglass-split', 'Diproses'],
                            'selesai' => ['bg-emerald-50 text-emerald-600 border-emerald-200', 'bi-check2-circle', 'Selesai'],
                        ];
                        $cfg = $statusConfig[$item->status] ?? $statusConfig['pending'];
                    @endphp
                    <span class="inline-flex items-center gap-1.5 text-[10px] font-black px-2.5 py-0.5 rounded-full border {{ $cfg[0] }}">
                        <i class="bi {{ $cfg[1] }}"></i> {{ $cfg[2] }}
                    </span>
                </div>

                <h4 class="font-black text-slate-900 text-base leading-snug mb-1">{{ $item->title }}</h4>
                <p class="text-sm text-slate-500 font-medium leading-relaxed line-clamp-2">{{ $item->content }}</p>

                {{-- Tanggapan Admin --}}
                @if($item->admin_response)
                <div class="mt-3 bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 flex gap-2">
                    <i class="bi bi-chat-left-quote text-blue-400 shrink-0 mt-0.5"></i>
                    <p class="text-xs text-slate-600 font-medium leading-relaxed">{{ $item->admin_response }}</p>
                </div>
                @endif

                {{-- Meta bawah --}}
                @if($item->handled_by && $item->handledBy)
                <p class="text-[10px] text-slate-300 font-medium mt-2">
                    Ditangani oleh: <span class="text-slate-400 font-bold">{{ $item->handledBy->name }}</span>
                    @if($item->processed_at) · {{ $item->processed_at->format('d M Y, H:i') }} @endif
                </p>
                @endif
            </div>

            {{-- Tombol Aksi --}}
            <div class="shrink-0">
                @if ($item->status !== 'selesai')
                    <button 
                    @click="openModal({{ $item->id }}, {{ json_encode($item->title) }}, '{{ $item->status }}', {{ json_encode($item->admin_response) }})"
                    class="flex items-center gap-2 px-4 py-2.5 bg-blue-600 text-white text-xs font-bold rounded-xl hover:bg-blue-700 shadow-md shadow-blue-200 transition-all active:scale-95">
                    <i class="bi bi-pencil-fill"></i>
                    Update
                </button>
               @else
                    <div class="flex items-center gap-2 px-4 py-2.5 bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-widest rounded-xl border border-emerald-100">
                        <i class="bi bi-check-circle-fill"></i>
                        Selesai
                    </div>
                @endif
               
            </div>

        </div>
    </div>
    @endforeach
</div>
@endif