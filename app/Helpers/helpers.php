<?php

if (!function_exists('formatNIP')) {
    function formatNIP($nip)
    {
        $cleanedNIP = preg_replace('/[^0-9]/', '', $nip);

        if (strlen($cleanedNIP) != 18) {
            return 'NIP tidak valid';
        }

        $part1 = substr($cleanedNIP, 0, 8);
        $part2 = substr($cleanedNIP, 8, 6);
        $part3 = substr($cleanedNIP, 14, 1);
        $part4 = substr($cleanedNIP, 15, 3);

        $formattedNIP = $part1 . ' ' . $part2 . ' ' . $part3 . ' ' . $part4;

        return $formattedNIP;
    }
}

if (!function_exists('formatNIDN')) {
    function formatNIDN($nidn)
    {
        $cleanedNIDN = preg_replace('/[^0-9]/', '', $nidn);

        if (strlen($cleanedNIDN) != 10) {
            return 'NIDN tidak valid';
        }

        $part1 = substr($cleanedNIDN, 0, 2);
        $part2 = substr($cleanedNIDN, 2, 8);
        $part3 = substr($cleanedNIDN, 8, 2);

        $formattedNIDN = $part1 . ' ' . $part2 . ' ' . $part3;

        return $formattedNIDN;
    }
}

if(!function_exists('formatNIM')) {
    function formatNIM($nim)
    {
        $cleanedNIM = preg_replace('/[^0-9]/', '', $nim);

        if (strlen($cleanedNIM) > 10 || strlen($cleanedNIM) < 8) {
            return 'NIM tidak valid';
        }

        $part1 = substr($cleanedNIM, 0, 2);
        $part2 = substr($cleanedNIM, 2, 3);
        $part3 = substr($cleanedNIM, 5, 4);

        $formattedNIM = $part1 . ' ' . $part2 . ' ' . $part3;

        return $formattedNIM;
    }
}

if (!function_exists('generateNIDN')) {
    function generateNIDN(string $initialTwoNumbers = '00')
    {
        $year = rand(1950, date('Y') - 20);
        $year = substr($year, 2, 2);
        $month = sprintf('%02d', rand(1, 12));
        $day = sprintf('%02d', rand(1, 31));
        $lastNumbers = sprintf('%02d', rand(1, 10));

        $nidn = $initialTwoNumbers . $day . $month . $year . $lastNumbers;

        return $nidn;
    }
}

if (!function_exists('generateNIP')) {
    function generateNIP($index, int $gender = 1)
    {
        $birthYear = rand(1950, date('Y') - 20);
        $birthMonth = sprintf('%02d', rand(1, 12));
        $day = sprintf('%02d', rand(1, 31));
        $initialEightNumbers = $birthYear . $birthMonth . $day;

        $liftingYear = rand($birthYear + 20, date('Y'));
        $liftingmonth = sprintf('%02d', rand(1, 12));
        $followingEightNumbers = $liftingYear . $liftingmonth;

        $followingOneNumber = $gender;

        $lastNumbers = str_pad($index, 3, '0', STR_PAD_LEFT);
        $nip = $initialEightNumbers . $followingEightNumbers . $followingOneNumber . $lastNumbers;

        return $nip;
    }
}
