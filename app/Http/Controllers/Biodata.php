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
    public function delete($id)
    {
        $data = DB::table('tbl_biodata')->where('id', $id)->get();
        if (count($data) > 0) {
            foreach ($data as $biodata) {
                if (file_exists(public_path('data_file/' . $biodata->foto))) {
                    @unlink(public_path('data_file/' . $biodata->foto));
                    DB::table('tbl_biodata')->where('id', $id)->delete();
                    $res['message'] = 'Berhasil!';
                    return response($res);
                }
            }
        } else {
            $res['message'] = 'Data Not Found!';
            return response($res);
        }
    }
    // ubah
    public function update(Request $request)
    {
        if (!empty($request->foto)) {
            $this->validate($request, [
                'foto' => 'required|max:2048'
            ]);

            $file = $request->file('foto');

            $nama_file = time() . '_' . $file->getClientOriginalName();
            $tujuan_upload = 'data_file';

            $file->move($tujuan_upload, $nama_file);

            $data = DB::table('tbl_biodata')->where('id', $request->id)->get();
            foreach ($data as $biodata) {
                @unlink(public_path('data_file/' . $biodata->foto));
                $ket = DB::table('tbl_biodata')->where('id', $request->id)->update([
                    'nama' => $request->nama,
                    'no_hp' => $request->no_hp,
                    'alamat' => $request->alamat,
                    'hobi' => $request->hobi,
                    'foto' => $nama_file
                ]);
            }
            $res['message'] = 'Berhasil!';
            return response($res);
        } else {
            $data = DB::table('tbl_biodata')->where('id', $request->id)->get();
            foreach ($data as $biodata) {
                $ket = DB::table('tbl_biodata')->where('id', $request->id)->update([
                    'nama' => $request->nama,
                    'no_hp' => $request->no_hp,
                    'alamat' => $request->alamat,
                    'hobi' => $request->hobi
                ]);
            }
            $res['message'] = 'Berhasil!';
            return response($res);
        }
    }

    // baca

}
