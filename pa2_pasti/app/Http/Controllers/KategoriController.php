<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;

class KategoriController extends Controller
{
    
    public function index()
    {
        $client = new Client();
        $url = "http://localhost:2005/kategori"; // Ganti URL sesuai dengan layanan kategori Anda

        try {
            $response = $client->request('GET', $url);
            $content = $response->getBody()->getContents();
            $contentArray = json_decode($content, true);

            if ($contentArray === false || !is_array($contentArray) || !isset($contentArray['data'])) {
                throw new \Exception('Invalid JSON response');
            }

            $kategori = $contentArray['data'];

            return view('kategori', [
                'data' => $kategori,
                'title' => 'Produk'
            ]);
        } catch (ConnectException $e) {
            return view('toko_down', [
                'title2' => 'Kategori',
                'title' => 'Server Down',
                'message' => 'The server is currently unavailable. Please try again later.'
            ]);
        } catch (RequestException $e) {
            return view('toko_down', [
                'title2' => 'Kategori',
                'title' => 'Server Down',
                'message' => 'There was an issue connecting to the server. Please try again later.'
            ]);
        } catch (\Exception $e) {
            return view('toko_down', [
                'title2' => 'Kategori',
                'title' => 'Error',
                'message' => 'There was an error processing the response: ' . $e->getMessage()
            ]);
        }
    }
    

    public function create()
    {
        return view('create_produk');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $response = Http::post("http://localhost:2005/kategori/create", [
            'nama_kategori' => $request->input('nama_kategori'),
        ]);

        if ($response->successful()) {
            return redirect()->route('kategori')->with('success', 'Data produk berhasil ditambahkan');
        } else {
            return response()->json([
                'message' => 'Gagal menambahkan data produk',
                'details' => $response->json(),
            ], $response->status());
        }
    }


    public function delete($id)
    {
        $response = Http::delete('http://localhost:2005/kategori/' . $id);

        if ($response->successful()) {
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function showUpdate($id)
    {
        $client = new Client();
        $url = "http://localhost:2005/kategori/" . $id;
    
        try {
            $response = $client->request('GET', $url);
            $content = $response->getBody()->getContents();
            $contentArray = json_decode($content, true);
    
            // Check if the data array contains the expected 'data' key
            if (isset($contentArray['data'])) {
                $product = $contentArray['data'];
            } else {
                // Handle the case where the expected data is not found
                return redirect()->back()->with('error', 'Data kategori tidak ditemukan');
            }
    
            return view('edit_kategori', [
                'data' => $product,
                'title' => 'Edit Kategori'
            ]);
    
        } catch (\Exception $e) {
            // Handle exceptions (e.g., network issues, invalid JSON response)
            return redirect()->back()->with('error', 'Gagal mendapatkan data dari server: ' . $e->getMessage());
        }
    }
    

    public function update(Request $request, $id)
    {
        $response = Http::put("http://localhost:2005/kategori/" . $id, [
            'nama_kategori' => $request->input('nama_kategori'),
        ]);
        
        if ($response->successful()) {
            return redirect()->route('kategori')->with('success', 'Data kategori berhasil diperbarui');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui data produk');
        }
    }
}