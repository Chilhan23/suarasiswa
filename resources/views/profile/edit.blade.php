<x-app-layout>
    {{-- Header Section --}}
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center text-white shadow-lg shadow-blue-200">
                <i class="bi bi-person-gear text-xl"></i>
            </div>
            <h2 class="font-black text-2xl text-slate-900 leading-tight">
                Pengaturan Profil
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            {{-- Card Update Password --}}
            <div class="p-6 sm:p-10 bg-white border border-slate-200 shadow-xl shadow-slate-200/50 rounded-[2rem] transition-all hover:shadow-2xl hover:shadow-slate-200/60">
                <div class="max-w-2xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Card Delete Account --}}
            <div class="p-6 sm:p-10 bg-white border border-slate-200 shadow-xl shadow-slate-200/50 rounded-[2rem] transition-all">
                <div class="max-w-2xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>