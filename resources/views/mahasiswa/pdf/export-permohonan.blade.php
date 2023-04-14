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
            <li style="padding-bottom:0.5em;"> Nomor <span style="margin-left: 70px;">:</span></li>
            <li style="padding-bottom:0.5em;"> Lampiran <span style="margin-left: 53px;">: -</span></li>
            <li style="padding-bottom:0.5em;"> Hal <span style="margin-left: 92px;">: Permohonan Kerja Praktek</span></li>
         </ul>
      </div>

      <div class="tujuan">
         <ul style="list-style-type: none; padding: 0;">
            <li style="padding-bottom:0.5em;"> Yth. Bapak/Ibu HR</li>
            <li style="padding-bottom:0.5em;"> PT Radya Anugrah Digital</li>
            <li style="padding-bottom:0.5em;"> di Tempat</li>
         </ul>
      </div>

      <div class="isi">
         <p style="text-indent: 50px;">Dalam rangka menyelesaikan mata kuliah kerja praktek, mahasiswa Fakultas Teknik
            yang tersebut di bawah ini: 
         </p>
         <ul style="list-style-type: none; padding: 0;">
            <li style="padding-bottom:0.5em;"> Nama <span style="margin-left: 80px;">: Dimas Rafi</span></li>
            <li style="padding-bottom:0.5em;"> NIM <span style="margin-left: 87px;">: Dimas Rafi</span></li>
            <li style="padding-bottom:0.5em;"> Prodi/Jurusan <span style="margin-left: 30px;">: Dimas Rafi</span></li>
            <li style="padding-bottom:0.5em;"> Alamat <span style="margin-left: 70px;">: Dimas Rafi</span></li>
            <li style="padding-bottom:0.5em;"> Semester <span style="margin-left: 58px;">: 5</span></li>
         </ul>
            <br>

            <p style="text-indent: 50px; text-align:justify; line-height:150%">Akan melaksanakan Program Kerja Praktek di PT Radya Anugerah Digital selama 3
            bulan pada bulan Januari 2022 hingga Maret 2022 atau sesuai kebijakan Instansi terkait.
            Mohon berkenan sekiranya dapat menerima mahasiswa tersebut untuk melaksanakan kerja
            praktek dan dibantu untuk mendapatkan data berupa laporan tentang kegiatan yang dilakukan
            di PT Radya Anugerah Digital.
         </p>
            
         <p style="text-indent: 50px;">Atas perhatian dan bantuannya kami ucapkan terima kasih.</p>

         


      </div>
    </section>
    <section class="footer">
      <div class="ttd">
         <span style="line-height: 150%;">Semarang, 3 Januari 2022</span>
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
