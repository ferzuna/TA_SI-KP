<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Surat Permohonan KP</title>
   <style type="text/css">

   @media print {
      @page{
         size: a4 potrait;
         margin: 0;
         padding: 0;
      }
   }


    .head {
      display: grid;
      grid-template-columns: auto auto auto auto;
      grid-gap: 10px;
      padding: 10px;
      
    }
    .logo-undip {
      display: flex;
      justify-content: center;
    }

    img.logo  {
      height: 100px;
      width: 100%;
    }

    .title-wrap {
      display: block !important;
      color: #000066;
      align-items: center;
      margin: 0.5em 0 0 0;
    }
    .alamat-wrap {
      text-align: right;
      color: #000066;
      font-size: 9pt;
    }

    .body {
      margin: 1em 4em;
    }

    
    .footer {
      display: flex;
      justify-content: right;
      margin: 2em 3em
    }

    .footer  {
      margin-top: 10vh;
    }
   </style>
   
   
</head>

<body onload="window.print()">
    <section class="head">
      <div class="logo-undip">
         <img class="logo" src="{{ asset('img/logoUndip.svg') }}" alt="Logo Undip">
      </div>
      <div class="title-wrap">
         <b style="font-size: 11pt">KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN</b>
         <br>
         <b style="font-size: 16pt;">UNIVERSITAS DIPONEGORO</b>
         <br>
         <b style="font-size:16pt;">FAKULTAS TEKNIK</b>
      </div>
      <div class="alamat-wrap">
         <span>Jalan Prof. Soedarto, S.H.</span>
         <br>
         <span>Tembalang Semarang Kode Pos 50275</span>
         <br>
         <span>Tel. (024) 7460055, (024) 7460053, Faks.</span>
         <br>
         <span>(024) 7460053</span>
         <br>
         <span>www.ft.undip.ac.id .email:teknik@undip.ac.id</span>
      </div>
    </section>

    <section class="body">
      <div class="no-surat">
         <ul style="list-style-type: none; padding: 0;">
            <li style="padding-bottom:0.5em;"> Nomor <span style="margin-left: 70px;">: .../UN7.F3.5/KM/I/2023</span></li>
            <li style="padding-bottom:0.5em;"> Lampiran <span style="margin-left: 53px;">: -</span></li>
            <li style="padding-bottom:0.5em;"> Hal <span style="margin-left: 92px;">: Pengantar Permohonan Kerja Praktik</span></li>
         </ul>
      </div>

      <div class="tujuan">
         <ul style="list-style-type: none; padding: 0;">
            <li style="padding-bottom:0.5em;"> Yth. Wakil Dekan Bidang Akademik dan Kemahasiswaan Fakultas Teknik UNDIP</li>
            <li style="padding-bottom:0.5em;"> di Tempat</li>
         </ul>
      </div>

      <div class="isi">
         <p style="text-indent: 50px;">Dalam rangka menyelesaikan mata kuliah kerja praktek, mahasiswa Departemen Teknik Komputer
            yang tersebut di bawah ini: 
         </p>
         <ul style="list-style-type: none; padding: 0;">
            <li style="padding-bottom:0.5em;"> Nama <span style="margin-left: 80px;">: {{Auth::user()->name}}</span></li>
            <li style="padding-bottom:0.5em;"> Prodi/Jurusan <span style="margin-left: 30px;">: S1 Teknik Komputer</span></li>
         </ul>

            <p style="text-indent: 50px; text-align:justify; line-height:150%">Akan melaksanakan Program Kerja Praktik pada {{ Carbon\Carbon::parse($permohonan->mulai)->isoFormat('D MMMM Y') }} s/d {{ Carbon\Carbon::parse($permohonan->selesai)->isoFormat('D MMMM Y') }} atau sesuai kebijakan Perusahaan. Mohon berkenan untuk dapat dibuatkan surat permohonan kerja praktik ke instansi berikut:
            </p>

            <ul style="list-style-type: none; padding: 0;">
                <li style="padding-bottom:0.5em;"> Nama Instansi<span style="margin-left: 30px;">: {{$permohonan->perusahaan}}</span></li>
             </ul>
         
            
         <p style="text-indent: 50px;">Atas perhatian dan bantuannya kami ucapkan terima kasih.</p>

         


      </div>
    </section>
    <section class="footer">
      <div class="ttd">
         <span style="line-height: 150%;">Semarang, {{$permohonan->updated_at->isoFormat('D MMMM Y')}}</span>
         <br>
         <span style="line-height: 150%;">a.n Dekan</span>
         <br>
         <span style="line-height: 150%;">Ketua Departemen Teknik Komputer</span>
         <br>
         <span style="line-height: 150%;">Fakultas Teknik</span>
         <br>
         <span style="line-height: 150%;">Universitas Dispanonegoro</span>
         <br>
         <br>
         <br>
         <br>
         <br>
         <br>
         <span style="line-height: 150%; text-decoration:underline;">Dr. Adian Fatchur Rochim S.T., M.T.</span>
         <br>
         <span>NISP. 197302261998021001</span>
      </div>
    </section>
</body>

</html>