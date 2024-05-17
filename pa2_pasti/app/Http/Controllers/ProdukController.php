<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;

class ProdukController extends Controller
{
    // public function getProdukApi()
    // {
    //     // Inisialisasi Guzzle HTTP client
    //     $client = new \GuzzleHttp\Client();
    
    //     // URL untuk endpoint produk dan kategori
    //     $urlProduk = "http://localhost:9011/produk";
    //     $urlKategori = "http://localhost:2005/kategori";
    
    //     try {
    //         // Permintaan untuk data produk
    //         $responseProduk = $client->request('GET', $urlProduk);
    //         $produkArray = json_decode($responseProduk->getBody()->getContents(), true);
    
    //         // Buat array untuk menyimpan data kategori
    //         $kategoriData = [];
    
    //         // Iterasi melalui produk untuk mendapatkan kategori
    //         foreach ($produkArray as &$item) {
    //             $idKategori = $item['id_kategori'] ?? null;
    
    //             // Mendapatkan data kategori berdasarkan id_kategori
    //             if ($idKategori !== null && !isset($kategoriData[$idKategori])) {
    //                 $responseKategori = $client->request('GET', "{$urlKategori}/{$idKategori}");
    //                 if ($responseKategori->getStatusCode() === 200) {
    //                     $kategori = json_decode($responseKategori->getBody()->getContents(), true);
    //                     $kategoriData[$idKategori] = $kategori;
    //                 }
    //             }
    //         }
    //         return view('produk', [
    //             'data' => $produkArray,
    //             'dataKategori' => $kategoriData,
    //             'title' => 'Produk'
    //         ]);
    //     } catch (\GuzzleHttp\Exception\ConnectException $e) {
    //         // Penanganan jika ada masalah koneksi
    //         return view('toko_down', [
    //             'title2' => 'Produk',
    //             'title' => 'Server Down',
    //             'message' => 'The server is currently unavailable. Please try again later.'
    //         ]);
    //     } catch (\GuzzleHttp\Exception\RequestException $e) {
    //         // Penanganan untuk kesalahan permintaan lainnya
    //         return view('produk_down', [
    //             'title' => 'Server Down',
    //             'message' => 'There was an issue connecting to the server. Please try again later.'
    //         ]);
    //     } catch (\GuzzleHttp\Exception\GuzzleException $e) {
    //         // Penanganan kesalahan umum Guzzle
    //         return view('error', [
    //             'title' => 'Error',
    //             'message' => 'An error occurred. Please try again later.'
    //         ]);
    //     }
    // }

public function getProdukApi()
{
    $id = null;

    try {
        // Mendapatkan data pelayan
        $response = Http::get("http://localhost:9011/produk");
        $produk = $response->successful() ? $response->json() : [];

        // Buat array untuk menyimpan data jemaat
        $kategoriData = [];

        foreach ($produk as &$item) {
            $id = $item['id_kategori'] ?? null;

            // Mendapatkan data jemaat berdasarkan id_jemaat
            if ($id !== null) {
                $response_kategori = Http::get("http://localhost:2005/kategori/{$id}");
                if ($response_kategori->successful()) {
                    $kategori = $response_kategori->json();
                    $kategoriData[$id] = $kategori['data'];
                }
            }
        }

        return view('produk', [
            "produk" => $produk,
            "kategoriData" => $kategoriData
        ]);

    } catch (\Exception $e) {
        // Handle exceptions (such as connection issues, timeouts, etc.)
        return view('toko_down', [
            'title2' => 'Produk',
            'title' => 'Server Down',
            'message' => 'The server is currently unavailable. Please try again later.'
        ]);
    }
}


    public function tambahProduk(Request $request)
            {
                try {
                    $request->validate([
                        'nama' => 'required|string|max:255',
                        'harga' => 'required|string|max:255',
                        'stok' =>  'required|string|max:255',
                        'deskripsi' => 'nullable|string',
                        'id_kategori' => 'required|integer',
                    ]);

                    $response = Http::post("http://localhost:9011/produk", [
                        'nama' => $request->input('nama'), // Sesuaikan dengan nama field yang diharapkan oleh API
                        'harga' => $request->input('harga'),
                        'stok' => $request->input('stok'),
                        'deskripsi' => $request->input('deskripsi'),
                        'id_kategori' => intval($request->id_kategori),
                    ]);
            
                    if ($response->successful()) {
                        // Data berhasil ditambahkan ke API, tambahkan penanganan sesuai kebutuhan Anda di sini
                        return redirect()->route('produk')->with('success', 'Data produk berhasil ditambahkan');
                    } else {
                        // Gagal menambahkan data ke API, berikan informasi kepada pengguna
                        return redirect()->back()->withInput()->with('error', 'Gagal menambahkan data produk. Respons API: ' . $response->status());
                    }
                } catch (\Exception $e) {
                    // Terjadi kesalahan dalam melakukan permintaan POST ke API
                    return redirect()->back()->withInput()->with('error', 'Gagal menambahkan data produk. Kesalahan: ' . $e->getMessage());
                }
        }
            



public function showTambahProdukForm()
{
    // Fetch categories from your API
    $response = Http::get('http://localhost:2005/kategori');

    // Check if the request was successful and response is in JSON format
    if ($response->successful() && $response->json()) {
        $responseData = $response->json();

        // Check if the success key is true
        if ($responseData['success'] && isset($responseData['data'])) {
            $dataKategori = $responseData['data'];

            // Debugging: Log or print the data to check if it is correct
            // You can use dd() for debugging
            // dd($dataKategori);

            // Pass the categories to the view
            return view('tambah_produk', ['dataKategori' => $dataKategori]);
        } else {
            return redirect()->back()->with('error', 'Gagal mengambil data kategori.');
        }
    } else {
        return redirect()->back()->with('error', 'Gagal mengambil data kategori atau data tidak valid.');
    }
}



    public function deleteProduk($id)
    {
        $response = Http::delete('http://localhost:9011/produk/' . $id);

        if ($response->successful()) {
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function showEditProdukForm($id)
{
    // Ambil data produk dari API atau database
    $client = new Client();
    $url = "http://localhost:9011/produk/" . $id;
    $response = $client->request('GET', $url);

    $content = $response->getBody()->getContents();
    $data = json_decode($content, true);

    // Ambil data kategori dari API atau database
    $responseKategori = Http::get('http://localhost:9011/kategori');

    // Periksa apakah permintaan berhasil dan data diterima dalam format JSON
    if ($responseKategori->successful() && $responseKategori->json()) {
        $dataKategori = $responseKategori->json();

        // Periksa apakah kategori berhasil diambil
        if (isset($dataKategori['data'])) {
            $kategoriOptions = [];

            // Iterasi melalui daftar kategori dan buat opsi dropdown
            foreach ($dataKategori['data'] as $kategori) {
                $kategoriOptions[$kategori['id']] = $kategori['nama_kategori'];
            }

            // Pass opsi kategori ke view
            return view('edit_produk', [
                'data' => $data,
                'kategoriOptions' => $kategoriOptions
            ]);
        } else {
            return redirect()->back()->with('error', 'Gagal mengambil data kategori.');
        }
    } else {
        return redirect()->back()->with('error', 'Gagal mengambil data kategori atau data tidak valid.');
    }
}


public function showUpdate($id)
{
    // Fetch product data
    $client = new Client();
    $url = "http://localhost:9011/produk/" . $id;
    $response = $client->request('GET', $url);

    $content = $response->getBody()->getContents();
    $productData = json_decode($content, true);

    // Fetch categories
    $response = Http::get('http://localhost:2005/kategori');

    // Check if the request was successful and response is in JSON format
    if ($response->successful() && $response->json()) {
        $responseData = $response->json();

        // Check if the success key is true
        if ($responseData['success'] && isset($responseData['data'])) {
            $kategoriOptions = collect($responseData['data'])->pluck('nama_kategori', 'id');

            // Pass product data and category options to the view
            return view('edit_produk', [
                'data' => $productData,
                'kategoriOptions' => $kategoriOptions,
                'title' => 'Produk'
            ]);
        } else {
            return redirect()->back()->with('error', 'Gagal mengambil data kategori.');
        }
    } else {
        return redirect()->back()->with('error', 'Gagal mengambil data kategori atau data tidak valid.');
    }
}

    public function updateProduk(Request $request, $id)
    {
        $response = Http::put("http://localhost:9011/produk/" . $id, [
            'nama' => $request->input('nama'),
            'harga' => $request->input('harga'),
            'stok' => $request->input('stok'),
            'deskripsi' => $request->input('deskripsi'),
            'id_kategori' => intval($request->id_kategori),

        ]);

        if ($response->successful()) {
            return redirect()->route('produk')->with('success', 'Data produk berhasil diperbarui');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui data produk');
        }
    }


    // function updateProduk(Request $request, $id) {
    //     try {
    //         $request->validate([
    //             'nama' => 'required|string|max:255',
    //             'harga' => 'required|string|max:255',
    //             'stok' =>  'required|string|max:255',
    //             'deskripsi' => 'nullable|string',
    //             'id_kategori' => 'required|integer',
    //         ]);

    //         $response = Http::put("http://localhost:9011/produk" .$id, [
    //             'nama' => $request->input('nama'), // Sesuaikan dengan nama field yang diharapkan oleh API
    //             'harga' => $request->input('harga'),
    //             'stok' => $request->input('stok'),
    //             'deskripsi' => $request->input('deskripsi'),
    //             'id_kategori' => intval($request->id_kategori),
    //         ]);    
    //         if ($response->successful()) {
    //             // Data berhasil ditambahkan ke API, tambahkan penanganan sesuai kebutuhan Anda di sini
    //             return redirect()->route('produk')->with('success', 'Data produk berhasil ditambahkan');
    //         } else {
    //             // Gagal menambahkan data ke API, berikan informasi kepada pengguna
    //             return redirect()->back()->withInput()->with('error', 'Gagal menambahkan data produk. Respons API: ' . $response->status());
    //         }
    //     } catch (\Exception $e) {
    //         // Terjadi kesalahan dalam melakukan permintaan POST ke API
    //         return redirect()->back()->withInput()->with('error', 'Gagal menambahkan data produk. Kesalahan: ' . $e->getMessage());
    //     }
    // }

    
}