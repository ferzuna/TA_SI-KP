@component('mail::message')
    <p> Yth. Kepala Departemen Teknik Komputer Undip,

        Perkenalkan saya {{ $nama }} dengan NIM {{ $nim }} dengan jumlah sks kumulatif {{ $sks }}.
        Ingin mengajukan surat rekomendasi dari departemen dan proposal permohonan KP di perusahaan {{ $perusahaan }}.


        Berikut link proposal dan dokumen yang telah saya isi

        Proposal : {{ $proposal }}
        Dokumen Permohonan : {{ $dokumen }}


        Sekian dari saya. Terima kasih atas perhatian Bapak/Ibu. Harap mengirimkan dokumen yang sudah di tanda tangan di email {{ $email }}



        Terima kasih banyak,
        {{ $nama }}
    
@endcomponent
