<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Middleware\AddTokenToRequest;
use  Illuminate\Support\Facades\Cookie;


class AuthController extends Controller
{
    // public function showLoginForm()
    // {
    //     return view('auth.login');
    // }

    public function showLoginForm()
    {
        try {
            return view('auth.login');
        } catch (\Exception $e) {
            // Handle exceptions (such as issues with the view rendering)
            return view('toko_down', [
                'title2' => 'Login',
                'title' => 'Server Down',
                'message' => 'An error occurred while trying to load the login form. Please try again later.'
            ]);
        }
    }


    // public function login(Request $request)
    // {
    //     if (Cookie::get('token')) {
    //         return redirect()->route('produk');
    //     }

    //     try {
    //         $credentials = $request->only('username', 'password');

    //         // Send POST request to the Go server
    //         $response = Http::post('http://localhost:8083/login', $credentials);

    //         // Check the response status
    //         if ($response->successful()) {
    //             $data = $response->json();

    //             if ($data['message'] == 'login berhasil') {
    //                 $token = $data['token'] ?? null;

    //                 if ($token) {
    //                     // Set the token as a cookie in the response
    //                     return redirect()->route('produk')
    //                                      ->cookie('token', $token, 60, null, null, false, true);
    //                 } else {
    //                     return back()->withErrors(['message' => 'Token not found']);
    //                 }
    //             } else {
    //                 return back()->withErrors(['message' => $data['message']]);
    //             }
    //         } else {
    //             return back()->withErrors(['message' => 'Login failed']);
    //         }
    //     } catch (\Throwable $th) {
    //         return redirect()->route('login.show')->with('error','Server Login sedang Down');
    //     }
    // }


    public function login(Request $request)
{
    // Check if the user is already logged in by checking the token cookie
    if (Cookie::get('token')) {
        return redirect()->route('produk');
    }

    try {
        // Get the credentials from the request
        $credentials = $request->only('username', 'password');

        // Send POST request to the Go server for login
        $response = Http::post('http://localhost:8083/login', $credentials);

        // Check if the response was successful
        if ($response->successful()) {
            $data = $response->json();

            // Check if the login was successful
            if ($data['message'] == 'login berhasil') {
                $token = $data['token'] ?? null;

                if ($token) {
                    // Set the token as a cookie in the response and redirect to produk
                    return redirect()->route('produk')
                                     ->cookie('token', $token, 60, null, null, false, true);
                } else {
                    // Token was not found in the response
                    return back()->withErrors(['message' => 'Token not found']);
                }
            } else {
                // Login message was not successful
                return back()->withErrors(['message' => $data['message']]);
            }
        } else {
            // The response was not successful
            return back()->withErrors(['message' => 'Login failed']);
        }
    } catch (\Exception $e) {
        // Catch any exceptions and redirect to a "server down" page
        return view('toko_down', [
            'title2' => 'Login',
            'title' => 'Server Down',
            'message' => 'The login server is currently unavailable. Please try again later.'
        ]);
    }
}




    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        
        try {
            $response = Http::post('http://localhost:8083/register', [
                'username' => $request->input('username'),
                'password' => $request->input('password'),
                'nama_lengkap' => $request->input('nama_lengkap'),
            ]);

            if ($response->ok()) {
                return redirect()->route('login')->with('success', 'Registration successful! Please login.'); // Redirect ke halaman login setelah registrasi berhasil
            } else {
                return redirect()->back()->getMesaage(); // Redirect kembali ke halaman registrasi dengan pesan kesalahan
            }
        } catch (\Throwable $th) {
            return redirect()->route('login.show')->with('error','Tidak bisa melakukan register');
        }
    }

    public function logout(Request $request)
    {
        // Send POST request to the Go server to handle logout
        $response = Http::withCookies($request->cookies->all(), 'localhost')
                        ->post('http://localhost:8083/logout');

        // Check the response statusp
        if ($response->successful()) {
            // Redirect to login page and clear the token cookie
            return redirect()->route('login.show')
                             ->withCookie(cookie()->forget('token'));
        } else {
            // Handle failed response
            return response()->json(['message' => 'Logout failed'], 500);
        }
    }
}