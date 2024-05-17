<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Exception;

class UlasanController extends Controller
{
//     public function getUlasanApi()
// {
//     $client = new Client();
//     $url = "http://localhost:9013/ulasan";
//     $response = $client->request('GET', $url);
//     $content = $response->getBody()->getContents();
//     $contentArray = json_decode($content, true);

//     $hiddenUlasan = collect($contentArray)->where('is_hidden', true);
//     $visibleUlasan = collect($contentArray)->where('is_hidden', false);

//     // print_r($hiddenUlasan);
//     return view('ulasan', [
//         'hiddenUlasan' => $hiddenUlasan,
//         'visibleUlasan' => $visibleUlasan,
//         'title' => 'Ulasan'
//     ]);
// }

public function getUlasanApi()
{
    $client = new Client();
    $url = "http://localhost:9013/ulasan";

    try {
        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);

        $hiddenUlasan = collect($contentArray)->where('is_hidden', true);
        $visibleUlasan = collect($contentArray)->where('is_hidden', false);

        return view('ulasan', [
            'hiddenUlasan' => $hiddenUlasan,
            'visibleUlasan' => $visibleUlasan,
            'title' => 'Ulasan'
        ]);

    } catch (\Exception $e) {
        // Handle exceptions (such as connection issues, timeouts, etc.)
        return view('toko_down', [
            'title2' => 'Ulasan',
            'title' => 'Server Down',
            'message' => 'The server is currently unavailable. Please try again later.'
        ]);
    }
}

    

public function hide($id)
{
    try {
        // Kirim permintaan PUT ke microservice untuk mengubah is_hidden menjadi true
        $response = Http::put("http://localhost:9013/ulasan/{$id}", [
            'is_hidden' => true,
        ]);

        // Cek status respons
        if ($response->successful()) {
            // Respons berhasil, redirect ke halaman ulasan dengan pesan sukses
            return redirect()->route('ulasan')->with('success', 'Ulasan berhasil disembunyikan');
        } else {
            // Respons gagal, ambil pesan error dari microservice
            $errorMessage = $response->json()['message'] ?? 'Gagal menyembunyikan ulasan';
            return redirect()->back()->with('error', $errorMessage);
        }
    } catch (Exception $e) {
        // Tangani exception yang mungkin terjadi
        return redirect()->back()->with('error', 'Terjadi kesalahan saat menyembunyikan ulasan');
    }
}

public function unhide($id)
{
    try {
        // Kirim permintaan PUT ke microservice untuk mengubah is_hidden menjadi true
        $response = Http::put("http://localhost:9013/ulasan/{$id}", [
            'is_hidden' => false,
        ]);

        // Cek status respons
        if ($response->successful()) {
            // Respons berhasil, redirect ke halaman ulasan dengan pesan sukses
            return redirect()->route('ulasan')->with('success', 'Ulasan berhasil disembunyikan');
        } else {
            // Respons gagal, ambil pesan error dari microservice
            $errorMessage = $response->json()['message'] ?? 'Gagal menyembunyikan ulasan';
            return redirect()->back()->with('error', $errorMessage);
        }
    } catch (Exception $e) {
        // Tangani exception yang mungkin terjadi
        return redirect()->back()->with('error', 'Terjadi kesalahan saat menyembunyikan ulasan');
    }
}
}
