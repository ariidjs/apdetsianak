<?php

namespace App\Http\Controllers;
use App\Models\Anak;
use App\Models\GrowAnak;
use App\Models\IdentitasAnak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AnakController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function insert(Request $request)
    {
        $name_ayah = $request->input('nama_ayah');
        $nama_ibu = $request->input('nama_ibu');
        $no_kk = $request->input('no_kk');
        $phone = $request->input('phone');
        $alamat = $request->input('alamat');
        $kelurahan = $request->input('kelurahan');

        $phonecheck = Anak::wherePhone($phone)->first();
        $nokkCheck = Anak::whereno_kk($no_kk)->first();

        if ($nokkCheck) {
            return response()->json([
                'success' => false,
                'message' => 'No. KK yang anda masukan telah terdaftar',
            ], 401);
        }

        if ($phonecheck) {
            return response()->json([
                'success' => false,
                'message' => 'No. HP yang anda masukan telah terdaftar',
            ], 401);
        }

        $insert = Anak::create([
            'nama_ayah' => $name_ayah,
            'nama_ibu' => $nama_ibu,
            'no_kk' => $no_kk,
            'password' => Hash::make($no_kk),
            'phone' => $phone,
            'alamat' => $alamat,
            'kelurahan' => $kelurahan,
        ]);

        if ($insert) {
            return response()->json([
                'success' => true,
                'message' => 'success',
                'singupdata' => $insert
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'failed'
            ], 400);
        }
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $type = $request->input('type'); //type 1 = anak, 2 = petugas
        $data = Anak::whereno_kk($username)->first();

        if($type == 1) {
            if ($data) {
                if (Hash::check($password, $data->password)) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Login Berhasil!',
                        'logindata' => $data,
                    ], 200);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Password yang anda masukan salah',
                    ], 404);
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Email atau username yang anda masukan tidak tersedia',
                ], 404);
            }
        }else {
            
                if ($username == 'admin' &&$password == 'admin') {
                    return response()->json([
                        'success' => true,
                        'message' => 'Admin Login Berhasil',
                        'logindata' => $data,
                    ], 200);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Username & Password yang anda masukan salah',
                    ], 404);
                }
           
        }
    }

    public function insertIdentitasAnak($no_kk, Request $request)
    {
        $nama = $request->input('nama');
        $j_kelamin= $request->input('j_kelamin');
        $nik = $request->input('nik');
        $ttl = $request->input('ttl');
        $umur = $request->input('umur');
        $alamat = $request->input('alamat');

        $nikCheck = IdentitasAnak::wherenik($nik)->first();

        if ($nikCheck) {
            return response()->json([
                'success' => false,
                'message' => 'Nik yang anda masukan telah terdaftar',
            ], 401);
        }

        $insert = IdentitasAnak::create([
            'nama' => $nama,
            'j_kelamin' => $j_kelamin,
            'no_kk' => $no_kk,
            'ttl' =>$ttl,
            'umur' => $umur,
            'alamat' => $alamat,
            'nik' => $nik
        ]);

        if ($insert) {
            return response()->json([
                'success' => true,
                'message' => 'Sukses tambah data anak'
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal tambah data anak'
            ], 401);
        }
    }
    public function getAnaks($no_kk)
    {
        $data = IdentitasAnak::whereno_kk($no_kk)->orderBy('created_at', 'ASC')->get();

        if ($data) {
            return response()->json([
                'success' => true,
                'message' => 'success',
                'identitasdata' => $data
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data anak dengan No KK :'.$no_kk.' Tidak ditemukan',
            ], 404);
        }
    }

    public function insertGrowAnak($nik, Request $request)
    {
        $tgl_ukur = $request->input('tgl_ukur');
        $tmpt_ukur= $request->input('tmpt_ukur');
        $tinggi = $request->input('tinggi');
        $berat = $request->input('berat');
        $lingkar_kepala = $request->input('lingkar_kepala');
        $lingkar_lengan = $request->input('lingkar_lengan');
        
        $insert = GrowAnak::create([
            'tgl_ukur' => $tgl_ukur,
            'tmpt_ukur' => $tmpt_ukur,
            'tinggi' => $tinggi,
            'berat' =>$berat,
            'lingkar_kepala' => $lingkar_kepala,
            'lingkar_lengan' => $lingkar_lengan,
            'nik' => $nik
        ]);

        if ($insert) {
            return response()->json([
                'success' => true,
                'message' => 'Sukses tambah data pertumbuhan anak',
                'nik' => $nik
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal tambah data anak pertumbuhan anak'
            ], 401);
        }
    }

    public function getHistory($nik)
    {
        $data = GrowAnak::wherenik($nik)->orderBy('created_at', 'ASC')->get();

        if ($data) {
            return response()->json([
                'success' => true,
                'message' => 'success',
                'growdata' => $data
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data anak dengan NIK :'.$nik.' Tidak ditemukan',
            ], 404);
        }
    }
}
