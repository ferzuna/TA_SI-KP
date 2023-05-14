<?php

namespace Tests\Unit;

use Mockery;
use Tests\TestCase;
use App\Models\User;
use App\Models\Bimbingan;
use App\Models\Permohonan;
use App\Models\Pendaftaran;
use App\Models\Penjadwalan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;


class MahasiswaTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function testStrlen()
{
    $length = strlen('hello');
    $this->assertEquals(5, $length);
}
public function testGetFullName()
{
    $user = new User;
    $user->first_name = 'John';
    $user->last_name = 'Doe';
    $this->assertEquals('John', $user->first_name);
}

public function testSetujuiLaporan()
{
    $bimbingan = Bimbingan::factory()->create();
    $id = $bimbingan->id;
    $this->get('/dosen/setujui-laporan/' . $id);

    $this->assertDatabaseHas('bimbingans', [
        'id' => $id,
        'status' => 'acc'
    ]);
    // $this->assertResponseRedirects('/dosen/bimbingan');
}






}
