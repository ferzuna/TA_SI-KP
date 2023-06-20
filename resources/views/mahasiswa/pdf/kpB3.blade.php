<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Surat Permohonan KP</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">
   <style type="text/css">

   @media print {
      @page{
         size: A4;
         margin: 0;
         padding: 0;
      }
   }


   * {
    font-size: 10pt;
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
      margin: 0 4em;
    }

    .no-surat {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .spelled {
      padding: 0px 5px;
      text-transform: capitalize;
    }
    
    .footer {
      margin: 0 4em;
    }

    .footer .times {
      text-align: right;
      padding-right: 10px;
    }
    

    .ttd-wrap {
        display: grid;
        grid-template-columns: auto auto auto auto;
        grid-gap: 5px;
        justify-content: right !important;
    }

    .ttd {
        padding: 0px 5px;
    }

    .user{
        text-align:center;
    }
   </style>
   
   
</head>

<body class="A4 potrait" onload="window.print()">
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
      <div class="tujuan">
        <div class="no-surat">
            <h4 style="margin-bottom: 0">FORM NILAI KERJA PRAKTIK (KP-B3)</h4>
        </div>
         <ul style="list-style-type: none; padding: 0;">
            <li style="padding-bottom:0.25em;"> Dengan ini Saya sebagai dosen pembimbing kerja praktek,</li>
            <li style="padding-bottom:0.25em;"> Nama <span style="margin-left: 30px;">: {{ $dosbing->name }}</li>
            <li style="padding-bottom:0.25em;"> NIP <span style="margin-left: 41px;">: {{ $dosbing->NIP }}</li>
         </ul>
      </div>

      <div class="isi">
         <ul style="list-style-type: none; padding: 0;">
            <li style="padding-bottom:0.25em;"> Memberikan nilai kepada mahasiswa : </li>
            <li style="padding-bottom:0.25em;"> Nama <span style="margin-left: 40px;">: {{Auth::user()->name}}</span></li>
            <li style="padding-bottom:0.25em;"> NIM <span style="margin-left: 46px;">: {{Auth::user()->NIM}}</span></li>
            <li style="padding-bottom:0.25em;"> Judul KP <span style="margin-left: 24px;">: </span></li>
         </ul>

         <ul style="list-style-type: none; padding: 0;">
            <li style="padding-bottom:0.25em;"> Adapun perincian nilai adalah sebagai berikut : </li>
            <li style="padding-bottom:0.25em;"> Nilai Seminar Kerja Praktik <span style="margin-left: 25px;">: <span style="margin-left:10px">88</span></span> <span style="margin-left: 10px;">( <span class="spelled">{{$spelled}}</span>)*</span></li>
            <li style="padding-bottom:0.25em;"> Nilai Laporan Kerja Praktik <span style="margin-left: 26px;">: <span style="margin-left:10px">88</span></span> <span style="margin-left: 10px;">( <span class="spelled">{{$spelled}}</span>)* </span></li>
         </ul>
      </div>
    </section>
    <section class="footer">
        <div class="times">
            <span style="line-height: 100%;">Semarang, 15 Desember 2023</span>
        </div>
        <div class="ttd-wrap">
            <div class="ttd">
                {{-- <div style="position:absolute; z-index:-2; margin-top:-5px; margin-bottom:-2em">
                   <img src="{{asset('img/TTD pak adian.png')}}" alt="" style="
                   width:100%;
                   height:125px;
                   ">
                </div> --}}
                <p class="user">Dosen Pembimbing</p>
                <br>
                <br>
                <br>
                <span class="user" style="line-height: 150%;">{{ $dosbing->name }}</span>
            </div>
        </div>
        <div>
         <span>* : <span>
            Nilai dalam angka dan huruf , misalnya 88 (=delapan puluh delapan=)
            <br>
            Score: 80 s.d. 100 = A; 70 s.d. 79 = B; 60 s.d. 69 = C</span>
         <br>
         </span>
        </div>
    </section>
</body>

</html>
