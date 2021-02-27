<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ApiAuthController extends Controller
{
    //fungsi untuk melakukan login
    //setelah berhasil login, fungsi ini akan mengembalikan token untuk 
    //diakses sanctum melalui aplikasi lain
    public function login(Request $request)
    {
        //melakukan validasi pada isian, disini email dan password wajib diisi
        $validate = \Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        //jika validasi gagal, maka API akan mengembalikan sebuah object
        //yang berisi pesan2 error dari suatu proses
        if ($validate->fails()) {
            $respon = [
                'status' => 'error',
                'msg' => 'Username dan password wajib diisi',
                'errors' => $validate->errors(),
                'content' => null,
            ];
            return response()->json($respon, 200);
        } else {
            //memanggil data pada tabel user, dengan email yang telah didapatkan dari proses POST
            $user = User::where('email', $request->email)->first();

            //jika user dg email tersebut tidak ditemukan
            //maka akan mengembalikan object dengan pesan error.
            if($user==null){
                $respon = [
                    'status' => 'error',
                    'msg' => 'Username atau password salah',
                    'errors' => "Username atau password salah",
                    'content' => null,
                ];
                return response()->json($respon, 200);
            }
            else{
                //jika user ditemukan, lakukan pengecekan kembali
                //apakah password yang dimasukkan dengan password pada database sama
                //jika beda, kemabalikan sebuah object dengan pesan error
                if (!\Hash::check($request->password, $user->password, [])) {
                    $respon = [
                        'status' => 'error',
                        'msg' => 'Username atau password salah',
                        'errors' => "Username atau password salah",
                        'content' => null,
                    ];
                    return response()->json($respon, 200);
                }
            }
            
            //jika username dan password sudah terkonfirmasi benar,
            //maka buatlah sebuah token yang dapat digunkana pada proses autentikasi sanctum
            $tokenResult = $user->createToken('token-auth')->plainTextToken;
            $respon = [
                'status' => 'success',
                'msg' => 'Login successfully',
                'errors' => null,
                'content' => [
                    'status_code' => 200,
                    'access_token' => $tokenResult,
                    'token_type' => 'Bearer',
                    'user_name' => $user->name,
                    'user_email' => $user->email,
                    'user_id' => $user->id,
                ]
            ];
            return response()->json($respon, 200);
        }
    }
}
