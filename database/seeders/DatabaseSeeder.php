<?php

namespace Database\Seeders;

use App\Models\Lecturer;
use App\Models\Student;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'id' => Str::uuid(),
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => bcrypt('admin'),
        ]);

        // Seeder untuk 10 data user dan dosen
        for ($i = 1; $i <= 3; $i++) {
            $nip = '196808' . sprintf('%03d', $i);
            $uuid = Str::uuid();
            $nidn = '00000000' . $i;
            $user = User::create([
                'id' => $uuid,
                'name' => Factory::create()->name(),
                'username' => $nidn,
                'email' => $nidn . '@unima.ac.id',
                'password' => bcrypt($nidn),
                'role' => 'lecturer',
            ]);

            Lecturer::create([
                'id' => Factory::create()->uuid(),
                'user_id' => $uuid,
                'nip' => $nip,
                'nidn' => $nidn,
                'front_degree' => 'Prof.',
                'back_degree' => 'Ph.D',
                'position' => 'Kaprodi',
                'rank' => 'Lektor Kepala',
                'phone_number' => '08' . sprintf('%09d', $i),
            ]);
        }

        $lecturers = Lecturer::all()->shuffle();

        for ($i = 1; $i <= 10; $i++) {
            $nim = '21208' . sprintf('%03d', $i);
            $uuid = Str::uuid();
            $user = User::create([
                'id' => $uuid,
                'name' => Factory::create()->name(),
                'email' => $nim . '@unima.ac.id',
                'username' => $nim,
                'password' => bcrypt($nim),
                'role' => 'student',
            ]);

            $supervisor = $lecturers->random()->getAttributes();

            Student::create([
                'id' => Factory::create()->uuid(),
                'user_id' => $uuid,
                'lecturer_id' => $supervisor['id'],
                'nim' => $nim,
                'batch' => 2021,
                'concentration' => $this->randomKonsentrasi(),
            ]);
        }
    }

    /**
     * Generate random konsentrasi.
     *
     * @return string
     */
    private function randomKonsentrasi()
    {
        $konsentrasiOptions = ['RPL', 'TKJ', 'Multimedia'];
        return collect($konsentrasiOptions)->random();
    }
}
