<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Balita;
use App\Models\User;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_add_balita_data()
    {
        $user = User::factory()->create();

        $response = $this->post(route('peserta.store', [
            'kategori' => 'balita',
            'user_id' => $user->id,
            
            'nik' => '123456789',
            'nama_balita' => 'Budi',
            'usia_tahun' => 3,
            'usia_bulan' => 2,
            'jenis_kelamin' => 'Laki-laki',
            'alamat' => 'Jl. Mawar No.1',
            'nama_orang_tua' => 'Pak Agus',
        ]));

        // pastikan redirect (berhasil)
        $response->assertStatus(302);

        // pastikan data benar-benar masuk database
        $this->assertDatabaseHas('balitas', [
            'nama_balita' => 'Budi',
        ]);
    }
}
