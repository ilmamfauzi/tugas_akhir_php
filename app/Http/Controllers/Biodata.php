<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\tbl_biodata;


class Biodata extends Controller
{
    // simpan
    public function create(Request $request)
    {
        $this->validate($request, [
            'foto' => 'required|max:2048'
        ]);

        $file = $request->file('foto');

        $nama_file = time() . '_' . $file->getClientOriginalName();
        $tujuan_upload = 'data_file';

        if ($file->move($tujuan_upload, $nama_file)) {
            $data = tbl_biodata::create([
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'hobi' => $request->hobi,
                'foto' => $nama_file
            ]);

            $res['message'] = 'Success!';
            $res['value'] = $data;

            return response($res);
        } else {
            $res['message'] = 'Error upload!';
            return response($res);
        }
    }
    // hapus

    // ubah

    // baca
}
