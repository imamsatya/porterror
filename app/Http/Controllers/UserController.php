<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\User;
use App\Models\Edcod;
use App\Models\Kodekab;
use App\Models\Foto;
use App\Models\Balasan;
use App\Models\Kegiatan;

use Illuminate\Support\Facades\Auth;

use Redirect;
use DB;
use Response;
use Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $edcod = Edcod::with('fotos', 'balasans');

       


        $edcod = $edcod->where('kab_id', $user->kab_id)
        ->get();
        
        if ($user->kab_id == 1) {
            $edcod = Edcod::with('fotos', 'balasans');
            $edcod = $edcod->get();
            
        }
        // dd($edcod[0]->fotos[0]->fotoname);
        
        return Inertia::render('Tabel', [
            'edcod' => $edcod
        ]);
    }
    public function getTabel()
    {
          $user = Auth::user();
        $edcod = new Edcod;
        $edcod = $edcod->where('kab_id', $user->kab_id)
        ->get();

        // dd($edcod);
        // return $ckpt;
        return response()->json([
    $edcod
]);
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
        //

        // dd($request);
        // dd($request[0]['kabupaten']);

        
        $kab = new Kodekab;
        $kab = $kab->where('name', 'like','%'.$request[0]['kabupaten'])->first();

        $kegiatan = new Kegiatan;
        $kegiatan = $kegiatan->where('bidang', $request[1])->where('kegiatan', $request[2])->first();
        

        
        $user = Auth::user();
        $edcod = new Edcod;
        // dd($request->foto[0]);
        $edcod->kabupaten = $request[0]['kabupaten'];
        $edcod->kecamatan = $request[0]['kecamatan'];
        $edcod->desa = $request[0]['desa'];
        $edcod->sls = $request[0]['sls'];
        $edcod->catatan_error = $request[0]['catatanError'];
        $edcod->status = 'open';
        $edcod->user_id = $user->id;
        $edcod->kab_id = $kab->id;
        $edcod->kegiatan_id = $kegiatan->id;
        $edcod->save();
        $destinationPath = public_path('/foto');
        // $destinationPath = 'foto';
         $i=1;
        foreach ($request[0]['foto'] as $foto) {
           
            $img = Image::make($foto['foto']->getRealPath());
                        $img->resize(375, 500, function ($constraint) {

            $constraint->aspectRatio();

        })->save($destinationPath.'/'.$edcod->id.'_'.$foto['id'].'.jpg');

        $fotox = new Foto;
        $fotox->fotoname = $edcod->id.'_'.$foto['id'].'.jpg';
        $fotox->edcod_id = $edcod->id;
        $fotox->path = $i;
        $fotox->save();
        $i=$i+1;

                        }
        
                
        

        //             $fileName = $edcod->id.'.'.$request->foto->getClientOriginalExtension();
        //   $request->foto->move('./foto', $fileName);

        //   $edcod->foto = $fileName;
          


        return Inertia::render('Dashboard');
    }
    public function jawabanStore(Request $request)
    {
        

        // $kab = $kab->where('name', 'like','%'.$request['kabupaten'])->first();

        
        $user = Auth::user();
        $edcod = new Edcod;
        $edcod = $edcod->where('id', $request->id)->first();
        $edcod->jawaban = $request->jawaban;
        $edcod->save();

        return \Redirect::route('tabel');
    }

     public function balasanStore(Request $request)
    {
        

        // $kab = $kab->where('name', 'like','%'.$request['kabupaten'])->first();

//    dd($request[0]['id']);
        $user = Auth::user();
        $edcod = new Edcod;
        $balasans = new Balasan;
        $balasans->balasan = $request[1];
        $balasans->edcod_id = $request[0]['id'];
        $balasans->user_id =$user->id;
        $balasans->save();

        return \Redirect::route('tabel');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        // dd($id);
         $edcod = new Edcod;
            $edcod = $edcod->where('id', $id)->first();
            
            $balasans = new Balasan;
            $balasan = $balasans->where('edcod_id', $edcod->id)->delete();

            $fotos = new Foto;
            $foto = $fotos->where('edcod_id', $edcod->id)->delete();
           
             $edcod = new Edcod;
            $edcod = $edcod->where('id', $id)->delete();
            
            // $edcod->save();
            return \Redirect::route('tabel');
    }

    public function closethread( $id)
    {
          $edcod = new Edcod;
            $edcod = $edcod->where('id', $id)->first();
            $edcod->status = 'closed';
            $edcod->save();

                        return \Redirect::route('tabel');

    }

      public function openthread( $id)
    {
          $edcod = new Edcod;
            $edcod = $edcod->where('id', $id)->first();
            $edcod->status = 'open';
            $edcod->save();

                        return \Redirect::route('tabel');

    }

    public function getKegiatan()
    {

        $kegiatans = new Kegiatan;
        $user = Auth::user();
        if ($user->id == 1) {
            
            $kegiatans = $kegiatans->get();
            
        }else{
        $kegiatans = $kegiatans->where('user_id', $user->id)
        ->get();
        }
        return Inertia::render('Kegiatan', [
            'kegiatans' => $kegiatans
        ]);
    }

    public function postKegiatan(Request $request)
    {
        // dd($request);
        $user = Auth::user();
        $kegiatan = new Kegiatan;
        $kegiatan->bidang = $request->bidang;
        $kegiatan->kegiatan = $request->kegiatan;
        $kegiatan->user_id = $user->id;
        $kegiatan->save();

        return \Redirect::route('kegiatan');

    }

    public function editKegiatan(Request $request)
    {
        // dd($request);
        $user = Auth::user();
        $kegiatan = new Kegiatan;
        $kegiatan = $kegiatan->where('id', $request->id)->first();
        $kegiatan->bidang = $request->bidang;
        $kegiatan->kegiatan = $request->kegiatan;
        $kegiatan->user_id = $user->id;
        $kegiatan->save();

        return \Redirect::route('kegiatan');

    }

    public function deleteKegiatan(Request $request)
    {
        
        $user = Auth::user();
        $kegiatan = new Kegiatan;
        $kegiatan = $kegiatan->where('id', $request->id)->delete();
        
        return \Redirect::route('kegiatan');

    }

    public function getSelectedBidang( $request)
    {
        
        
        $kegiatan = new Kegiatan;
        $kegiatan = $kegiatan->where('bidang', $request)->get();
        
        return response()->json([
            $kegiatan
        ]);
       
        
    
    }
}
