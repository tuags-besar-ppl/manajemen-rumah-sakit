@extends('layouts.app_manager')

@section('content')
<div class="container mx-auto">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-xl shadow-lg">
            <div class="p-6 border-b border-gray-100">
                <h5 class="text-xl font-semibold text-gray-800">
                    Kirim Email
                </h5>
            </div>
            <div class="p-6">
                <form action="{{ route('manager.email.send') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    @if(session('success'))
                        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div>
                        <label for="to" class="block text-sm font-medium text-gray-700 mb-2">Kepada</label>
                        <input type="email" 
                               class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 shadow-sm hover:border-gray-400 transition-colors @error('to') border-red-500 @enderror" 
                               id="to" 
                               name="to" 
                               placeholder="Masukkan alamat email"
                               value="{{ old('to') }}" 
                               required>
                        @error('to')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subjek</label>
                        <input type="text" 
                               class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 shadow-sm hover:border-gray-400 transition-colors @error('subject') border-red-500 @enderror" 
                               id="subject" 
                               name="subject" 
                               placeholder="Masukkan subjek email"
                               value="{{ old('subject') }}" 
                               required>
                        @error('subject')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Pesan</label>
                        <textarea class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 shadow-sm hover:border-gray-400 transition-colors @error('message') border-red-500 @enderror" 
                                id="message" 
                                name="message" 
                                rows="8"
                                placeholder="Tulis pesan email di sini"
                                required>{{ old('message') }}</textarea>
                        @error('message')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="template" class="block text-sm font-medium text-gray-700 mb-2">Template</label>
                        <select class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 shadow-sm hover:border-gray-400 transition-colors" 
                                id="template" 
                                onchange="loadTemplate(this.value)">
                            <option value="">Pilih Template</option>
                            <option value="laporan_harian">Laporan Harian</option>
                            <option value="pemberitahuan">Pemberitahuan</option>
                            <option value="pengumuman">Pengumuman</option>
                        </select>
                    </div>

                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="reset" 
                                class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors shadow-sm">
                            Reset
                        </button>
                        <button type="submit" 
                                class="px-6 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors shadow-sm">
                            Kirim Email
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
const templates = {
    laporan_harian: {
        subject: "Laporan Harian Peralatan Rumah Sakit - [Tanggal]",
        message: `Dengan hormat,

Berikut adalah laporan harian mengenai status peralatan rumah sakit:

1. Total Peralatan: [Jumlah]
2. Peralatan Tersedia: [Jumlah]
3. Peralatan Digunakan: [Jumlah]
4. Peralatan Rusak: [Jumlah]


Terima Kasih atas perhatian dan kerjasamanya.,
arya`
    },
    pemberitahuan: {
        subject: "Pemberitahuan - Pemeliharaan Peralatan",
        message: `Kepada Yth.
[Nama Penerima]

Dengan ini kami informasikan bahwa akan dilakukan pemeliharaan rutin untuk peralatan-peralatan berikut:

1. [Nama Peralatan 1]
2. [Nama Peralatan 2]
3. [Nama Peralatan 3]

Pemeliharaan akan dilakukan pada:
Tanggal: [Tanggal]
Waktu: [Waktu]
Lokasi: [Lokasi]

Mohon kerjasamanya untuk mengatur penggunaan peralatan pada waktu tersebut.

Terima kasih,
arya`
    },
    pengumuman: {
        subject: "Pengumuman - Peralatan Baru",
        message: `Kepada seluruh staff,

Dengan senang hati kami informasikan bahwa telah tersedia peralatan baru:

Nama Peralatan: [Nama]
Lokasi: [Lokasi]
Jumlah Unit: [Jumlah]

Untuk penggunaan peralatan ini, mohon mengikuti prosedur yang berlaku.

Terima kasih,
arya`
    }
};

function loadTemplate(templateName) {
    if (!templateName) return;
    
    const template = templates[templateName];
    if (template) {
        document.getElementById('subject').value = template.subject;
        document.getElementById('message').value = template.message;
    }
}
</script>
@endpush
@endsection 