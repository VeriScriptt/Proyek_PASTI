<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProdukController2 extends Controller
{
    function pelayan()
    {
        // Inisialisasi $id dengan nilai default
        $id = null;

        // Mendapatkan data pelayan
        $response = Http::get("http://localhost:9014/pelayan/");
        $pelayan = $response->successful() ? $response->json() : [];

        // Buat array untuk menyimpan data jemaat
        $jemaatData = [];

        foreach ($pelayan as &$item) {
            if (!empty($item['tanggal_terima_jabatan'])) {
                $date = new \DateTime($item['tanggal_terima_jabatan']);
                $item['tanggal_terima_jabatan'] = $date->format('Y-m-d');
            }

            if (!empty($item['tanggal_akhir_jabatan'])) {
                $date = new \DateTime($item['tanggal_akhir_jabatan']);
                $item['tanggal_akhir_jabatan'] = $date->format('Y-m-d');
            }

            // Mendapatkan id_jemaat
            $id = $item['id_jemaat'] ?? null;

            // Mendapatkan data jemaat berdasarkan id_jemaat
            if ($id !== null) {
                $response_jemaat = Http::get("http://localhost:9013/jemaat/{$id}");
                if ($response_jemaat->successful()) {
                    $jemaat = $response_jemaat->json();
                    if (!empty($jemaat['tanggal_lahir'])) {
                        $date = new \DateTime($jemaat['tanggal_lahir']);
                        $jemaat['tanggal_lahir'] = $date->format('Y-m-d');
                    }
                    $jemaatData[$id] = $jemaat;
                }
            }
        }

        return view('Pendeta.datapelayan', [
            "pelayan" => $pelayan,
            "jemaatData" => $jemaatData
        ]);
    }



    function formpelayan()
    {
        $response_jemaat = Http::get("http://localhost:9013/jemaat/");
    if ($response_jemaat->successful()) {
        $jemaat = $response_jemaat->json();
        if (!empty($jemaat['tanggal_lahir'])) {
            $date = new \DateTime($jemaat['tanggal_lahir']);
            $jemaat['tanggal_lahir'] = $date->format('Y-m-d');
        }
    } else {
        $jemaat = [];}

        return view("Pendeta.formdatapelayan", [
            "jemaat" => $jemaat
        ]);
    }

    function formpelayanprocess(Request $request)
    {
        try { 
            $request->validate([
                'nik' => ['required', 'int', 'max:10'],
                'peran' => ['required', 'string', 'max:255', 'in:Pendeta,Sekretaris,Bendahara,Penatua,Pelayan Ibadah,Seksi Pelayanan Rohani,Seksi Pekabaran Injil,Seksi Diakoni,Seksi Musik/Nyanyian/Koor,Seksi Sekolah Minggu,Seksi Pemuda/i (PP),Pengawas Harta Benda,Penasehat Jemaat'],
                'tanggal_terima_jabatan' => ['required', 'date'],
                'tanggal_akhir_jabatan' => ['nullable'],
            ]);

            $response = Http::post('http://localhost:9014/pelayan/', [

                'id_jemaat' => intval($request->nik),
                'peran' => $request->peran, 
                'tanggal_terima_jabatan' => $request->tanggal_terima_jabatan.'T00:00:00+07:00',
                'tanggal_akhir_jabatan' => $request->tanggal_akhir_jabatan.'T00:00:00+07:00'
            ]);
            if ($response->successful()) {
                return redirect('/pendeta/pelayangereja')->with('success', 'Data berhasil ditambah');
            } else {
                return redirect('/pendeta/pelayangereja')->with('error', 'Terjadi kesalahan saat menambah data');
            }
        } catch (\Throwable $th) {
            return redirect('/pendeta/pelayangereja')->with('error', $th->getMessage());
    }
}
   

public function editdatapelayan($id)
{
    // Inisialisasi $id_jemaat dengan nilai default
    $id_jemaat = null;

    // Mendapatkan data pelayan
    $response = Http::get("http://localhost:9014/pelayan/{$id}");
    if ($response->successful()) {
        $pelayanas = $response->json();
        
        // Memeriksa dan memformat tanggal_terima_jabatan
        if (!empty($pelayanas['tanggal_terima_jabatan'])) {
            $date = new \DateTime($pelayanas['tanggal_terima_jabatan']);
            $pelayanas['tanggal_terima_jabatan'] = $date->format('Y-m-d');
        }

        // Memeriksa dan memformat tanggal_akhir_jabatan (jika ada)
        if (!empty($pelayanas['tanggal_akhir_jabatan'])) {
            $date = new \DateTime($pelayanas['tanggal_akhir_jabatan']);
            $pelayanas['tanggal_akhir_jabatan'] = $date->format('Y-m-d');
        }

        // Mendapatkan id_jemaat
        $id_jemaat = $pelayanas['id_jemaat'] ?? null;
    } else {
        $pelayanas = null;
    }

    // Mendapatkan data jemaat berdasarkan id_jemaat
    $jemaatData = [];
    if ($id_jemaat !== null) {
        $response_jemaat = Http::get("http://localhost:9013/jemaat/{$id_jemaat}");
        if ($response_jemaat->successful()) {
            $jemaat = $response_jemaat->json();
            if (!empty($jemaat['tanggal_lahir'])) {
                $date = new \DateTime($jemaat['tanggal_lahir']);
                $jemaat['tanggal_lahir'] = $date->format('Y-m-d');
            }
            $jemaatData[$id_jemaat] = $jemaat;
        }
    }

    return view('pendeta.editpelayan', [
        "pelayanas" => $pelayanas,
        "jemaatData" => $jemaatData
    ]);   
}

    function updatedatapelayan(Request $request, $id) {
        try { 
            $request->validate([
                'peran' => ['required', 'string', 'max:255', 'in:Pendeta,Sekretaris,Bendahara,Penatua,Pelayan Ibadah,Seksi Pelayanan Rohani,Seksi Pekabaran Injil,Seksi Diakoni,Seksi Musik/Nyanyian/Koor,Seksi Sekolah Minggu,Seksi Pemuda/i (PP),Pengawas Harta Benda,Penasehat Jemaat'],
                'tanggal_terima_jabatan' => ['required', 'date'],
                'tanggal_akhir_jabatan' => ['nullable'],
            ]);

            $response = Http::put("http://localhost:9014/pelayan/{$id}", [
                'peran' => $request->peran, 
                'tanggal_terima_jabatan' => $request->tanggal_terima_jabatan.'T00:00:00+07:00',
                'tanggal_akhir_jabatan' => $request->tanggal_akhir_jabatan.'T00:00:00+07:00'
            ]);
            if ($response->successful()) {
                return redirect('/pendeta/pelayangereja')->with('success', 'Data berhasil ditambah');
            } else {
                return redirect('/pendeta/pelayangereja')->with('error', 'Terjadi kesalahan saat menambah data');
            }
        } catch (\Throwable $th) {
            return redirect('/pendeta/pelayangereja')->with('error', $th->getMessage());
    }
    }
}
