<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;

class TokoController extends Controller
{
    /**
     * Display a listing of the stores.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new Client();
        $url = "http://localhost:9012/toko";
    
        try {
            $response = $client->request('GET', $url);
            $content = $response->getBody()->getContents();
            $contentArray = json_decode($content, true);
            
            return view('toko', [
                'data' => $contentArray,
                'title' => 'Toko'
            ]);
        } catch (ConnectException $e) {
            // Handle the connection exception specifically for connection issues
            return view('toko_down', [
                'title2' => 'Profile',
                'title' => 'Server Down',
                'message' => 'The server is currently unavailable. Please try again later.'
            ]);
        }
    }  

    /**
     * Show the form for creating a new store.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('toko.create');
    }

    /**
     * Store a newly created store in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_toko' => 'required|max:255',
            'nama_lengkap' => 'required|max:255',
            'nomor_kios' => 'required|max:20',
            'lantai' => 'required|max:20',
            'email' => 'required|email|max:255',
            'nomor_telepon' => 'required|max:20',
        ]);

        $response = Http::post('http://localhost:9012/toko', $validatedData);

        if ($response->successful()) {
            return redirect()->route('toko.index')
                ->with('success', 'Toko berhasil ditambahkan.');
        } else {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan toko.');
        }
    }

    public function storee(Request $request)
    {
        $response = Http::post("http://localhost:9011/produk", [
            'nama' => $request->input('nama'),
            'harga' => $request->input('harga'),
            'stok' => $request->input('stok'),
            'deskripsi' => $request->input('deskripsi'),
        ]);

        if ($response->successful()) {
            return redirect()->route('produk')->with('success', 'Data produk berhasil ditambahkan');
        } else {
            return response()->json([
                'message' => 'Gagal menambahkan data produk'
            ], 404);
        }
    }

    /**
     * Display the specified store.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = new Client();
        $url = "http://localhost:9012/toko/" . $id;
    
        try {
            $response = $client->request('GET', $url);
            $content = $response->getBody()->getContents();
            $contentArray = json_decode($content, true);
    
            // Debugging output
            Log::info('API Response:', ['content' => $contentArray]);
    
            // Check if 'ID' key exists in the array
            if (!isset($contentArray['ID'])) {
                Log::error('ID key is missing in the API response.');
                return view('error_page', [
                    'message' => 'Invalid API response',
                    'title' => 'Error'
                ]);
            }
    
            return view('edit_toko', [
                'data' => $contentArray,
                'title' => 'Toko'
            ]);
        } catch (RequestException $e) {
            Log::error('API Request Error:', ['message' => $e->getMessage()]);
    
            if ($e->hasResponse() && $e->getResponse()->getStatusCode() == 404) {
                // Handle 404 error
                return view('error_page', [
                    'message' => 'Product not found',
                    'title' => 'Error'
                ]);
            } else {
                // Handle other possible errors (e.g., server error)
                return view('error_page', [
                    'message' => 'An error occurred: ' . $e->getMessage(),
                    'title' => 'Error'
                ]);
            }
        }
    }

    /**
     * Show the form for editing the specified store.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = Http::get('http://localhost:9012/toko/' . $id);
        $toko = $response->json();

        return view('toko.edit', compact('toko'));
    }

    /**
     * Update the specified store in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_toko' => 'required|max:255',
            'nama_lengkap' => 'required|max:255',
            'nomor_kios' => 'required|max:20',
            'lantai' => 'required|max:20',
            'email' => 'required|email|max:255',
            'nomor_telepon' => 'required|max:20',
        ]);

        $response = Http::put('http://localhost:9012/toko/' . $id, $validatedData);

        if ($response->successful()) {
            return redirect()->route('toko.index')
                ->with('success', 'Toko berhasil diperbarui.');
        } else {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui toko.');
        }
    }
}