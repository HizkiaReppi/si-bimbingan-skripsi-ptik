@php
    $supervisor = [];
    if (request()->routeIs('dashboard.bimbingan-1.print')) {
        $supervisor = [
            'number' => 'I',
            'name' => $student->firstSupervisorFullname,
            'nip' => $student->firstSupervisor->formattedNIP,
        ];
    } else {
        $supervisor = [
            'number' => 'II',
            'name' => $student->secondSupervisorFullname,
            'nip' => $student->secondSupervisor->formattedNIP,
        ];
    }
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Bimbingan Skripsi {{ $student->fullname }}</title>
    <style>
        @page {
            size: A4;
            margin: 1.5cm 1cm 1cm 1.5cm;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        a {
            color: #000;
            text-decoration: none;
        }

        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 12pt;
            line-height: 1.5;
            overflow-x: scroll;
            background-color: #ffffff;
        }

        /* Container */
        .container {
            max-width: 21cm;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            position: relative;
            text-align: center;
            padding-bottom: 5px;
            border-bottom: 3px solid black;
        }

        .logo {
            position: absolute;
            top: 15px;
            left: 0;
            width: 80px;
        }

        /* Text Transform */
        .uppercase {
            text-transform: uppercase;
        }

        /* Font Size */
        .text-14pt {
            font-size: 14pt;
        }

        /* Text Alignment */
        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        /* Font Weight */
        .font-bold {
            font-weight: bold;
        }

        /* Display */
        .inline-block {
            display: inline-block;
        }

        /* Flexbox */
        .flex {
            display: flex;
        }

        .justify-center {
            justify-content: center;
        }

        /* Width */
        .w-label {
            width: 50px;
        }

        .w-10 {
            width: 10px;
        }

        .w-1\/2 {
            width: 50%;
        }

        .w-full {
            width: 100%;
        }

        /* Margin */
        .mt-10 {
            margin-top: 10px;
        }

        .mt-15 {
            margin-top: 15px;
        }

        .mt-30 {
            margin-top: 30px;
        }

        .mt-60 {
            margin-top: 60px;
        }

        .mb-20 {
            margin-bottom: 20px;
        }

        .my-0 {
            margin-top: 0;
            margin-bottom: 0;
        }

        .mx-25 {
            margin-left: 25px;
            margin-right: 25px;
        }

        /* Negative Margin */
        .-mb-8 {
            margin-bottom: -8px;
        }

        /* Padding */
        .p-40 {
            padding: 40px;
        }

        .py-0 {
            padding-top: 0;
            padding-bottom: 0;
        }

        .px-15 {
            padding-left: 15px;
            padding-right: 15px;
        }

        /* Height */
        .h-75 {
            height: 75px;
        }

        /* Table Border */
        .border-table {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 8px;
        }

        .border-t {
            border-top-width: 1px;
        }

        .border-t-solid {
            border-top-style: solid;
        }

        .border-black {
            border-color: black;
        }

        /* Vertical Alignment */
        .v-align-top {
            vertical-align: top;
        }
    </style>

</head>

<body>
    <div class="container">
        <header>
            <p class="text-16pt font-medium">KEMENTRIAN PENDIDIKAN, KEBUDAYAAN, <br> RISET DAN TEKNOLOGI</p>
            <p class="text-16pt"><strong>UNIVERSITAS NEGERI MANADO</strong></p>
            <p class="text-16pt"><strong>FAKULTAS TEKNIK</strong></p>
            <p><strong>JURUSAN PENDIDIKAN TEKNOLOGI INFORMASI DAN KOMUNIKASI</strong></p>
            <p>Alamat : Kampus UNIMA Tondano 95618</p>
            <p>Laman : <a href="https://ptik.unima.ac.id">https://ptik.unima.ac.id</a></p>
            <img src="/logo-unima.png" alt="Logo Unima" class="logo">
        </header>

        <div>
            <h1 class="uppercase text-center text-14pt mt-10">Kartu Bimbingan Skripsi</h1>
        </div>
        <div>
            <table class="mt-10">
                <tr>
                    <td class="w-label text-left v-align-top">Nama</td>
                    <td class="v-align-top w-10">:</td>
                    <td>{{ $student->fullname }}</td>
                </tr>
                <tr>
                    <td class="w-label text-left v-align-top">NIM</td>
                    <td class="v-align-top w-10">:</td>
                    <td>{{ $student->formattedNIM }}</td>
                </tr>
            </table>

            <table class="border-table mt-30">
                <thead>
                    <tr>
                        <th class="border-table font-semibold">NO</th>
                        <th class="border-table font-semibold">TGL KONSULTASI</th>
                        <th class="border-table font-semibold text-nowrap">TOPIK POKOK YANG DIBICARAKAN</th>
                        <th class="border-table font-semibold">TANDA TANGAN PEMBIMBING {{ $supervisor['number'] }}</th>
                        <th class="border-table font-semibold">TGL MENGHADAP KEMBALI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($guidances as $guidance)
                        <tr>
                            <td class="border-table text-center">{{ $loop->iteration }}</td>
                            <td class="border-table text-center">
                                {{ \Carbon\Carbon::parse($guidance->schedule)->format('d/m/Y') }}</td>
                            <td class="border-table">{{ $guidance->topic }}</td>
                            <td class="border-table"></td>
                            <td class="border-table"></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="text-center mt-30">
                <table class="w-full">
                    <tr>
                        <td></td>
                        <td>
                            <table class="w-full">
                                <tbody class="my-0 mx-25">
                                    <tr>
                                        <td class="text-left">Ketua Jurusan</td>
                                    </tr>
                                    <tr>
                                        <td class="h-75"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left font-bold">
                                            {{ $headOfDepartement->fullname }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-t border-t-solid border-black text-left font-bold">NIP.
                                            {{ $headOfDepartement->formattedNIP }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td class="p-40"></td>
                        <td>
                            <table class="w-full">
                                <tbody class="my-0 mx-25">
                                    <tr>
                                        <td class="text-left">Pembimbing {{ $supervisor['number'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="h-75"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left font-bold">
                                            {{ $supervisor['name'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-t border-t-solid border-black text-left font-bold">NIP.
                                            {{ $supervisor['nip'] }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    {{-- <script>
        window.print();

        window.onafterprint = function () {
            window.close();
            window.location.href = '/bimbingan';
        };
    </script> --}}
</body>

</html>
