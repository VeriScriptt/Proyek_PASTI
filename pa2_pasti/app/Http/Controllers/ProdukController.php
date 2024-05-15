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
    public function getProdukApi()
    {
        $client = new Client();
    
        // URL untuk endpoint produk dan kategori
        $urlProduk = "http://localhost:9011/produk";
        $urlKategori = "http://localhost:2005/kategori";
    
        try {
            // Permintaan untuk data produk
            $responseProduk = $client->request('GET', $urlProduk);
            $contentProduk = $responseProduk->getBody()->getContents();
            $produkArray = json_decode($contentProduk, true);
    
            // Permintaan untuk data kategori
            $responseKategori = $client->request('GET', $urlKategori);
            $contentKategori = $responseKategori->getBody()->getContents();
            $kategoriArray = json_decode($contentKategori, true);
    
            // Pastikan pengambilan data kategori berhasil
            $kategoriMap = [];
            if ($kategoriArray && isset($kategoriArray['success']) && $kategoriArray['success']) {
                $dataKategori = $kategoriArray['data'];
    
                // Buat associative array untuk kategori
                foreach ($dataKategori as $kategori) {
                    $kategoriMap[$kategori['id']] = $kategori['nama_kategori'];
                }
            }
    
            // Debugging
            // dd($produkArray, $kategoriMap);
    
            return view('produk', [
                'data' => $produkArray,
                'kategoriMap' => $kategoriMap,
                'title' => 'Produk'
            ]);
        } catch (ConnectException $e) {
            // Penanganan jika ada masalah koneksi
            return view('toko_down', [
                'title2' => 'Produk',
                'title' => 'Server Down',
                'message' => 'The server is currently unavailable. Please try again later.'
            ]);
        } catch (RequestException $e) {
            // Penanganan untuk kesalahan permintaan lainnya
            return view('produk_down', [
                'title' => 'Server Down',
                'message' => 'There was an issue connecting to the server. Please try again later.'
            ]);
        } catch (GuzzleException $e) {
            // Penanganan kesalahan umum Guzzle
            return view('error', [
                'title' => 'Error',
                'message' => 'An error occurred. Please try again later.'
            ]);
        }
    }
    
    

    public function create()
    {
        return view('create_produk');
    }

    public function addProduk(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'harga' => 'required|string|max:255',
        'stok' =>  'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'id_kategori' => 'required|string|max:255',
    ]);

    try {
        $response = Http::post("http://localhost:9011/produk", [
            'nama_produk' => $request->input('nama'), // Sesuaikan dengan nama field yang diharapkan oleh API
            'harga' => $request->input('harga'),
            'stok' => $request->input('stok'),
            'deskripsi' => $request->input('deskripsi'),
            'id_kategori' => $request->input('id_kategori'),
        ]);

        // dd($response);

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

    


    public function deleteProduk($id)
    {
        $response = Http::delete('http://localhost:9011/produk/' . $id);

        if ($response->successful()) {
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function showUpdate($id)
    {
        $client = new Client();
        $url = "http://localhost:9011/produk/" . $id;
        $response = $client->request('GET', $url);

        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        return view('edit_produk', [
            'data' => $contentArray,
            'title' => 'Produk'
        ]);
    }

    public function updateProduk(Request $request, $id)
    {
        $response = Http::put("http://localhost:9011/produk/" . $id, [
            'nama' => $request->input('nama'),
            'harga' => $request->input('harga'),
            'stok' => $request->input('stok'),
            'deskripsi' => $request->input('deskripsi'),
        ]);

        if ($response->successful()) {
            return redirect()->route('produk')->with('success', 'Data produk berhasil diperbarui');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui data produk');
        }
    }
}