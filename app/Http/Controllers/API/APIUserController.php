<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; //login
use Illuminate\Support\Facades\Hash; //password
use App\Model\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class APIUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
    
        $result = [];
        $i = 0;
        foreach ($users as $user) {
            $result[$i]['id'] = $user->id;
            $result[$i]['username'] = $user->username;
            $result[$i]['nama'] = $user->nama;
            $result[$i]['email'] = $user->email;
            $result[$i]['no_telp'] = ($user->no_telp) ? ($user->no_telp) : '-';
            $result[$i]['tanggal_lahir'] = ($user->tgl_lahir) ? ($user->tgl_lahir) : '-';
            $result[$i]['jenis_kelamin'] = ($user->jns_kelamin) ? ($user->jns_kelamin) : '-';
            $result[$i]['alamat'] = ($user->alamat) ? ($user->alamat) : '-';
            $result[$i]['role'] = (config('custom.role.'.$user->role)) ? (config('custom.role.'.$user->role)) : '-';
            $i++;
        }

        return response()->json([
            'data' => $result
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'=>'required',
            'email'=>'required',
            'username'=>'required',
            'password'=>'required',
            'role'=>'required',
        ]);

        $data = $request->except(['_token', '_method']);
        if($request->get('password')!=''){
            $data['password'] = bcrypt($request->get('password'));
        }
        $user = User::create($data);

        return response()->json([
            'message' => 'User berhasil ditambahkan'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            //
        ]);

        $user = User::find($id);
        $data = $request->except(['_token', '_method', 'password']);

        if($request->get('password')!=''){
            $data['password'] = bcrypt($request->get('password'));
        }

        $user->update($data);

        return redirect('/users')->with('success', 'User updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json([
            'message' => 'User berhasil dihapus',
            'data' => $user
        ]);
    }

    public function changePass()
    {
        return view('changepass');
    }

    public function changePassSubmit(Request $request, $id)
    {
        $request->validate([
            'old_pass'=>'required',
            'new_pass'=>'required',
            'con_pass'=>'required',
        ]);

        $user = User::find($id);
        if($request->get('new_pass') != $request->get('con_pass')){
            return redirect('/changepass')->with('error', 'Password baru tidak sama dengan konfirmasi password');
        }

        if(Hash::check($request->get('old_pass'), $user->password)){
            $user->password = bcrypt($request->get('new_pass'));
            $user->save();

            return redirect('/changepass')->with('success', 'Password updated!');
        } else {
            return redirect('/changepass')->with('error', 'Password lama salah');
        }
    }

    public function detail_user($id)
    {
        $user = User::findOrFail($id);
    
        $result['id'] = $user->id;
        $result['username'] = $user->username;
        $result['nama'] = $user->nama;
        $result['email'] = $user->email;
        $result['no_telp'] = ($user->no_telp) ? ($user->no_telp) : '-';
        $result['tanggal_lahir'] = ($user->tgl_lahir) ? ($user->tgl_lahir) : '-';
        $result['jenis_kelamin'] = ($user->jns_kelamin) ? ($user->jns_kelamin) : '-';
        $result['alamat'] = ($user->alamat) ? ($user->alamat) : '-';
        $result['role'] = (config('custom.role.'.$user->role));

        return response()->json([
            'data' => $result
        ], 200);
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
        
        $credentials = request(['username', 'password']);
        if(!Auth::attempt($credentials))
        return response()->json([
            'message' => 'Unauthorized'
        ], 401);
        
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        // dd($request);

        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        return response()->json([
            'code' => 200,
            'message' => 'Login Sukses',
            'data' => $tokenResult->accessToken,

        ]);
    }

    public function get_user_info(Request $request)
    {
        $user = $request->user;
        return response()->json([
            'message' => 'Berhasil mengambil data user',
            'data' => $user,
        ]);
    }   

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
