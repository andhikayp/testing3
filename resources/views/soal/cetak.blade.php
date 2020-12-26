<!DOCTYPE html>
<html>
<head>
<title>Print Paket: {{$packet->nama}}</title>
    <style>
        body {
            font-size: 12pt;
        }
        .container {
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
            }
            @media (min-width: 768px) {
            .container {
                width: 750px;
            }
            }
            @media (min-width: 992px) {
            .container {
                width: 970px;
            }
            }
            @media (min-width: 1200px) {
            .container {
                width: 1170px;
            }
            }
        .card {
            width: 94%;
            height: 96%;
            margin: auto;
        }
        table, th {
            text-align: center;
            border-collapse: collapse;
        }
        thead {
            border: 1px solid black;
        }
        td {
            text-align: left;
            font-size: 12pt;
        }
        tbody tr {
            align-content: center;
        }
        th h1 {
            margin: 0;
            font-weight: normal;
        }
        #th1 {
            font-size: 11pt;
            font-weight: bold;
            margin: 0;
            padding: 0;
        }
        h3 {
            text-align: center;
            margin-bottom: 7px;
            padding-top: 15px;
        }
        .bordered {
            border: 1px solid black;
            border-collapse: collapse;
        }
        .pict {
            margin: 0;
            padding: 0;
            vertical-align: middle;
        }
        p {
            /*padding-top: 20px;*/
            /*padding-bottom: 10px;*/
        }
        .tdName {
            width: 35%;
        }
        .tdValue {
            width: 65%;
            border-bottom: 1px solid black;
        }
        li {
            /*margin-bottom: -30px;*/
        }
        ol[type="A"] li {
            /*margin-bottom: -30px;*/
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <table style="text-align: center" width="100%">
                <thead>
                <tr>
                    <th><img class="pict" src="{{asset('img/tutwuri.jpg')}}" width="60px"></th>
                    <th><h1 id="th1">UJIAN SATUAN PENDIDIKAN BERBASIS KOMPUTER DAN SMARTPHONE<br>TAHUN PELAJARAN
                            2019/2020 <br>
                        MATA PELAJARAN: {{$packet->pelajaran->nama}} <br>
                        PAKET: {{$packet->nama}}
                        </h1>
                    <th><img class="pict" src="{{asset('img/logo_jatim.png')}}" height="60"></th>
                </tr>
                </thead>
            </table>
        </div>
        <ol class="questions">
            @foreach ($soals as $soal)
              <li>
                  {{-- <div class="q" style="margin-bottom: -70px"> --}}
                    <p>{!!$soal['deskripsi'] !!}</p>
                  {{-- </div> --}}
                
                @if ($soal['tipe_soal'] == 'pilihan_ganda')                      
          
                <ol type="A" style="padding-left: 25px">
                    <li >{!! $soal['pilihan_a'] !!}</li>
                    <li>{!! $soal['pilihan_b'] !!}</li>
                    <li>{!! $soal['pilihan_c'] !!}</li>
                    <li >{!! $soal['pilihan_d'] !!}</li>
                    @if($soal['pilihan_e'])
                    <li >{!! $soal['pilihan_e'] !!}</li>
                    @endif
                </ol><br><br>
                @endif
              </li>
            @endforeach
          </ol>
          
          <table width="100%" style="margin-top: 60px; border-collapse: separate">
            <tbody>
            <tr>
                <td class="bordered" style="text-align: center; "><strong>
                    </strong></td>
                <td class="bordered" style="text-align: center"><strong>
                    DINAS PENDIDIKAN PROVINSI JAWA TIMUR    
                </strong></td>
                <td class="bordered" style="text-align: center"><strong>
                </strong></td>
            </tr>
            </tbody>
        </table>
    </div>
</body>
</html>

