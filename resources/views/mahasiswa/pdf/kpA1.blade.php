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


   /* * {
    font-size: 11pt;
   } */
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
    
    .footer {
      margin: 0 4em;
    }

    .footer .times {
      text-align: right;
      padding-right: 10px;
      margin-bottom: 2vh;
    }
    
    .footer .menyetujui {
      text-indent: 4em;
    }

    .ttd-wrap {
        display: grid;
        grid-template-columns: auto auto auto auto;
        grid-gap: 5px;
        justify-content: space-between !important;
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
            <h4 style="margin-bottom: 0">FORM PERMOHONAN KERJA PRAKTIK (KP-A1)</h4>
        </div>
         <ul style="list-style-type: none; padding: 0;">
            <li style="padding-bottom:0.25em;"> Dengan ini Saya,</li>
            <li style="padding-bottom:0.25em;"> Nama <span style="margin-left: 30px;">: {{Auth::user()->name}}</li>
            <li style="padding-bottom:0.25em;"> NIM <span style="margin-left: 36px;">: {{Auth::user()->NIM}}</li>
         </ul>
      </div>

      <div class="isi">
    
         <ul style="list-style-type: none; padding: 0;">
            <li style="padding-bottom:0.25em;"> Ingin mengajukan permohonan Kerja Praktek di: </li>
            <li style="padding-bottom:0.25em;"> Instansi/Perusahaan <span style="margin-left: 12px;">: </span></li>
            <li style="padding-bottom:0.25em;"> Topik Kerja Praktek <span style="margin-left: 9px;">: </span></li>
            <li style="padding-bottom:0.25em;"> Waktu <span style="margin-left: 97px;">: 15 Desember 2023 s/d 23 Februari 2024</span></li>
         </ul>
      </div>
    </section>
    <section class="footer">
        <div class="times">
            <span style="line-height: 100%;">Semarang, 15 Desember 2023</span>
        </div>
        <div class="menyetujui">
            <span>Menyetujui,</span>
        </div>
        <div class="ttd-wrap">
            <div class="ttd">
               {{-- <div style="position:absolute; z-index:-2; margin-top:-5px; margin-bottom:-2em">
                  <img src="{{asset('img/TTD pak adian.png')}}" alt="" style="
                  width:100%;
                  height:125px;
                  ">
               </div> --}}
               <p class="user">Koordinator KP</p>
               <br>
               <br>
               <br>
               <span class="user" style="line-height: 150%;">Arseto Satriyo Nugroho, S.T., M.Eng.</span>
            </div>

            <div class="ttd">
                {{-- <div style="position:absolute; z-index:-2; margin-top:-5px; margin-bottom:-2em">
                   <img src="{{asset('img/TTD pak adian.png')}}" alt="" style="
                   width:100%;
                   height:125px;
                   ">
                </div> --}}
                <p class="user">Dosen Pembimbing KP</p>
                <br>
                <br>
                <br>
                <span class="user" style="line-height: 150%;">Patricia Evericho Mountaines, S.T., M.Cs.</span>
            </div>

            <div class="ttd">
                {{-- <div style="position:absolute; z-index:-2; margin-top:-5px; margin-bottom:-2em">
                   <img src="{{asset('img/TTD pak adian.png')}}" alt="" style="
                   width:100%;
                   height:125px;
                   ">
                </div> --}}
                <p class="user">Pemohon</p>
                <br>
                <br>
                <br>
                <span class="user" style="line-height: 150%;">Indriawan Muhammad Akbar</span>
            </div>
        </div>
    </section>
</body>

</html>
