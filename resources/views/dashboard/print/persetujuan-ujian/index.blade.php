<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Persetujuan Ujian Hasil Mahasiswa {{ $student->fullname }}</title>
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

        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 12pt;
            line-height: 2;
            overflow-x: scroll;
            background-color: #ffffff;
        }

        /* Container */
        .container {
            max-width: 21cm;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header */
        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 14pt;
            margin: 0;
            color: #333;
        }

        /* Text Transform */
        .uppercase {
            text-transform: uppercase;
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

        /* Flexbox */
        .flex {
            display: flex;
        }

        .justify-center {
            justify-content: center;
        }

        /* Width */
        .w-label {
            width: 100px;
        }

        .w-10 {
            width: 10px;
        }

        .w-full {
            width: 100%;
        }

        /* Margin */
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

        /* Border */
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
        <div class="header">
            <h1 class="uppercase">Lembar Persetujuan Ujian Hasil</h1>
        </div>
        <div>
            <table class="mt-30">
                <tr>
                    <td class="w-label text-left v-align-top">Judul Skripsi</td>
                    <td class="v-align-top w-10">:</td>
                    <td>{{ $student->thesis->title }}</td>
                </tr>
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

            <p class="text-center mt-30">
                Telah diperiksa dan disetujui oleh Tim Pembimbing Skripsi untuk diajukan pada <br>
                Ujian Hasil Penelitian Skripsi Jurusan Pendidikan Teknologi Informasi dan Komunikasi <br>
                Fakultas Teknik Universitas Negeri Manado
            </p>
            <p class="text-center mt-30">Tondano, <span id="date"></span></p>

            <div class="text-center">
                <p class="-mb-8">Menyetujui,</p>
                <p class="uppercase">TIM PEMBIMBING SKRIPSI</p>
                <table class="w-full">
                    <tr>
                        <td></td>
                        <td>
                            <table class="w-full">
                                <tbody class="my-0 mx-25">
                                    <tr>
                                        <td class="text-left">Pembimbing I,</td>
                                    </tr>
                                    <tr>
                                        <td class="h-75"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left font-bold">
                                            {{ $student->firstSupervisorFullname }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-t border-t-solid border-black text-left font-bold">NIP.
                                            {{ $student->firstSupervisor->formattedNIP }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td class="p-40"></td>
                        <td>
                            <table class="w-full">
                                <tbody class="my-0 mx-25">
                                    <tr>
                                        <td class="text-left">Pembimbing II,</td>
                                    </tr>
                                    <tr>
                                        <td class="h-75"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left font-bold">
                                            {{ $student->secondSupervisorFullname }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-t border-t-solid border-black text-left font-bold">NIP.
                                            {{ $student->secondSupervisor->formattedNIP }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td></td>
                    </tr>
                </table>
            </div>

            <div class="mt-60">
                <table class="w-full flex justify-center">
                    <tbody class="my-0 mx-25">
                        <tr>
                            <td class="py-0 px-15">Mengetahui, <br> Ketua Jurusan</td>
                        </tr>
                        <tr>
                            <td class="h-75 py-0 px-15"></td>
                        </tr>
                        <tr>
                            <td class="text-left font-bold py-0 px-15">{{ $headOfDepartement->fullname }}</td>
                        </tr>
                        <tr>
                            <td class="border-t border-t-solid border-black py-0 px-15 font-bold">NIP.
                                {{ $headOfDepartement->formattedNIP }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];

        const date = new Date();

        const day = date.getDate();
        const month = monthNames[date.getMonth()];
        const year = date.getFullYear();

        document.getElementById('date').textContent = `${day} ${month} ${year}`;

        window.print();

        window.onafterprint = function () {
            window.close();
            window.location.href = '/bimbingan';
        };
    </script>
</body>

</html>
