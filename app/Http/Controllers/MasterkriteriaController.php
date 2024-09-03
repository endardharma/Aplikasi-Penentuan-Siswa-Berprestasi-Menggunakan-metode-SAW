<?php

namespace App\Http\Controllers;

use App\Models\MasterKriteria;
use App\Models\TahunAjar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MasterkriteriaController extends Controller
{
    public function index()
    {
        return view('admin.masterkriteria.index');
    }

    // public function dataKriteria()
    // {
    //     $kriteria = MasterKriteria::all();
    //     $data = array();
    //     $totalBobotPercent = 0;
        
    //     foreach($kriteria as $k)
    //     {
    //         $item['id'] = $k->id;
    //         $item['kode'] = $k->kode;
    //         $item['name'] = $k->name;
    //         $item['atribut'] = $k->attribute;
    //         $item['bobot_percent'] = $k->bobot.' %';
    //         $item['bobot'] = $k->bobot;
    //         $item['kurikulum'] = $k->kurikulum;

    //         // $totalBobotPercent += $k->bobot;
            
    //         $data[] = $item;
    //     }

    //     // $warning = '';
    //     // if ($totalBobotPercent > 100)
    //     // {
    //     //     $warning = 'Peringatan: Total bobot tidak boleh lebih dari 100%. Total saat ini adalah ' . $totalBobotPercent . '%';
    //     // }

    //     return response()->json([
    //         'data' => $data,
    //         // 'warning' => $warning,
    //     ],200);
    // }

    // public function dataKriteria(Request $request)
    // {
    //     $columns = [
    //         0 => 'id',
    //         1 => 'kode',
    //         2 => 'name',
    //         3 => 'attribute',
    //         4 => 'bobot',
    //         5 => 'bobot_percent',
    //         6 => 'tajar_id',
    //     ];

    //     $totalBobotPercent = 0;
    //     $start = $request->start;
    //     $limit = $request->length;
    //     $orderColumn = $columns[$request->input('order.0.column')];
    //     $dir = $request->input('order.0.dir');
    //     $search = $request->input('search')['value'];
    //     $tajarId = $request->input('tajar_id');

    //     // Hitunga keseluruhan
    //     $hitung = MasterKriteria::count();
    //     // $kriteria = MasterKriteria::where(function ($q) use ($search) {
    //     //     if($search != null)
    //     //     {
    //     //         return $q->where('kode','LIKE','%'.$search.'%')->orWhere('name','LIKE','%'.$search.'%')->orwhere('attribute','LIKE','%'.$search.'%')->orwhere('tajar_id','LIKE','%'.$search.'%')->orWhere('bobot',$search);
    //     //     }
    //     // })->orderby($orderColumn, $dir)->skip($start)->take($limit)->get();
    //     // $data = array();

    //     // $query = MasterKriteria::with(['tajar'])
    //     // ->when($search, function ($query) use ($search) {
    //     //     $query->whereHas('tajar', function ($q) use ($search) {
    //     //         $q->where('periode','LIKE','%'. $search .'%');
    //     //     })
    //     //     ->orWhereHas('kode','LIKE','%'.$search.'%')
    //     //     ->orWhereHas('name','LIKE','%'.$search.'%')
    //     //     ->orWhereHas('attribut','LIKE','%'.$search.'%')
    //     //     ->orWhereHas('bobot','LIKE','%'.$search.'%');
    //     // });

    //     $query = MasterKriteria::with(['tajar'])
    //     ->when($tajarId, function ($query) use ($tajarId) {
    //         return $query->where('tajar_id', $tajarId);  // Filter berdasarkan tajar_id
    //     })
    //     ->when($search, function ($query) use ($search) {
    //         return $query->where(function ($q) use ($search) {
    //             $q->where('kode', 'LIKE', '%' . $search . '%')
    //               ->orWhere('name', 'LIKE', '%' . $search . '%')
    //               ->orWhere('attribute', 'LIKE', '%' . $search . '%')
    //               ->orWhere('bobot', 'LIKE', '%' . $search . '%')
    //               ->orWhereHas('tajar', function ($q) use ($search) {
    //                   $q->where('periode', 'LIKE', '%' . $search . '%');
    //               });
    //         });
    //     });
    //     $totalFiltered = $query->count();

    //     $kriteria = $query
    //     ->orderBy($orderColumn, $dir)
    //     ->skip($start)
    //     ->take($limit)
    //     ->get();

    //     $totalBobotPerTajar = [];
    //     $warning = '';

    //     $data = array();
    //     foreach($kriteria as $k)
    //     {
    //         $item['id'] = $k->id;
    //         $item['kode'] = $k->kode;
    //         $item['name'] = $k->name;
    //         $item['atribut'] = $k->attribute;
    //         $item['bobot_percent'] = $k->bobot.' %';
    //         $item['bobot'] = $k->bobot;

    //         $item['id_tajar_periode'] = $k->tajar_id;
    //         $item['tahun_ajar'] = $k->tajar->periode ?? '';
    //         $totalBobotPercent += $k->bobot;

            
    //         if (!isset($totalBobotPerTajar[$k->tajar_id]))
    //         {
    //             $totalBobotPerTajar[$k->tajar_id] = 0;
    //         }
    //         $totalBobotPerTajar[$k->tajar_id] += $k->bobot;
            
    //         $data[] = $item;
    //     }

    //     // $warning = '';
    //     // if ($totalBobotPercent > 100)
    //     // {
    //     //     $warning = 'Peringatan: Total bobot tidak boleh lebih dari 100%. Total bobot saat ini adalah ' . $totalBobotPercent . '%';
    //     // }

    //     foreach ($totalBobotPerTajar as $tajar_id => $totalBobot)
    //     {
    //         if ($totalBobot > 100)
    //         {
    //             $periode = $kriteria->firstWhere('tajar_id', $tajar_id)->tajar->periode;
    //             $warning .= 'Peringatan: Total bobot untuk periode '. $periode . 'melebihi 100%: ' .$totalBobot. '%. ';
    //         }
    //     }

    //     return response()->json([
    //         'draw' => $request->draw,
    //         'recordsTotal' => $hitung,
    //         'recordsFiltered' => $totalFiltered,
    //         'warning' => $warning,
    //         'data' => $data,
    //     ], 200);
    // }

    public function dataKriteria(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'kode',
            2 => 'name',
            3 => 'attribute',
            4 => 'bobot',
            5 => 'bobot_percent',
            6 => 'tajar_id',
        ];
    
        $start = $request->start;
        $limit = $request->length;
        $orderColumn = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search')['value'];
        $tajarId = $request->input('tajar_id');  // Sesuaikan dengan nama parameter yang dikirimkan dari front-end
    
        $query = MasterKriteria::with(['tajar'])
            ->when($tajarId, function ($query) use ($tajarId) {
                return $query->where('tajar_id', $tajarId);
                // if ($tajarId) {
                //     $query->where('id', $tajarId);
                // }
            })
            ->when($search, function ($query) use ($search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('kode', 'LIKE', '%' . $search . '%')
                    ->orWhere('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('attribute', 'LIKE', '%' . $search . '%')
                    ->orWhere('bobot', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('tajar', function ($q) use ($search) {
                        $q->where('periode', 'LIKE', '%' . $search . '%');
                    });
                });
            });
    
        $totalFiltered = $query->count();
    
        $kriteria = $query
            ->orderBy($orderColumn, $dir)
            ->skip($start)
            ->take($limit)
            ->get();
    
        $totalBobotPerTajar = [];
        $warning = '';
        $totalBobotPercent = 0;
    
        $data = [];
        foreach ($kriteria as $k) {
            $item['id'] = $k->id;
            $item['kode'] = $k->kode;
            $item['name'] = $k->name;
            $item['atribut'] = $k->attribute;
            $item['bobot_percent'] = $k->bobot . ' %';
            $item['bobot'] = $k->bobot;
            $item['id_tajar_periode'] = $k->tajar_id;
            $item['tahun_ajar'] = $k->tajar->periode ?? '';
    
            $totalBobotPercent += $k->bobot;
    
            if (!isset($totalBobotPerTajar[$k->tajar_id])) {
                $totalBobotPerTajar[$k->tajar_id] = 0;
            }
            $totalBobotPerTajar[$k->tajar_id] += $k->bobot;
    
            $data[] = $item;
        }
    
        foreach ($totalBobotPerTajar as $tajar_id => $totalBobot) {
            if ($totalBobot > 100) {
                $periode = $kriteria->firstWhere('tajar_id', $tajar_id)->tajar->periode ?? 'Unknown';
                $warning .= 'Peringatan: Total bobot untuk periode ' . $periode . ' melebihi 100%: ' . $totalBobot . '%. ';
            }
        }
    
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => MasterKriteria::count(),
            'recordsFiltered' => $totalFiltered,
            'warning' => $warning,
            'data' => $data,
        ], 200);
    }

    // public function tambahKriteria(Request $request)
    // {
    //     //set validation
    //     $validator = Validator::make($request->all(), [
    //         'kode' => 'required',
    //         'name' => 'required',
    //         'atribut' => 'required',
    //         'bobot' => 'required',
    //         'tajar_id' => 'required',
    //     ]);

    //     // cek total bobot
    //     $totalBobot = MasterKriteria::where('tajar_id', $request->tajar_id)->sum('bobot') + $request->bobot;

    //     if ($totalBobot > 100)
    //     {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Gagal menambahkan data, total bobot tidak boleh lebih dari 100%',
    //         ], 400);
    //     }

    //     //response error validation
    //     if($validator->fails()){
    //         return response()->json($validator->errors(), 400);
    //     }

    //     $kriteria = new MasterKriteria();
    //     $kriteria->kode = $request->kode;
    //     $kriteria->name = $request->name;
    //     $kriteria->attribute = $request->atribut;
    //     $kriteria->bobot = $request->bobot;
    //     $kriteria->tajar_id = $request->tajar_id;
    //     $kriteria->save();

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Berhasil menambahkan data kriteria baru',
    //     ],201);
    // }

    public function tambahKriteria(Request $request)
    {
        // set validation
        $validator = Validator::make($request->all(), [
            'kode' => 'required',
            'name' => 'required',
            'atribut' => 'required',
            'bobot' => 'required|numeric|min:0',
            'tajar_id' => 'required',
        ]);
    
        // response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
    
        // cek total bobot untuk periode yang sama (tajar_id)
        $totalBobot = MasterKriteria::where('tajar_id', $request->tajar_id)->sum('bobot') + $request->bobot;
    
        // jika total bobot lebih dari 100 untuk periode yang sama, gagalkan penambahan
        if ($totalBobot > 100) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan data, total bobot untuk periode ini tidak boleh lebih dari 100%',
            ], 400);
        }
    
        // jika validasi berhasil, tambahkan data kriteria baru
        $kriteria = new MasterKriteria();
        $kriteria->kode = $request->kode;
        $kriteria->name = $request->name;
        $kriteria->attribute = $request->atribut;
        $kriteria->bobot = $request->bobot;
        $kriteria->tajar_id = $request->tajar_id;
        $kriteria->save();
    
        return response()->json([
            'success' => true,
            'message' => 'Berhasil menambahkan data kriteria baru',
        ], 201);
    }
    

    public function updateData(Request $request,$id)
    {
        $find = MasterKriteria::where('id',$id)->first();
        if(!$find)
        {
            return response()->json([
                'success' => false,
                'message' => 'Update data kriteria gagal, data tidak ditemukan',
            ],400);
        }else{
            // cek total bobot
            $totalBobot = MasterKriteria::where('tajar_id', $request->tajar_id)->sum('bobot') + $request->bobot;

            if ($totalBobot > 100)
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menambahkan data, total bobot tidak boleh lebih dari 100%',
                ], 400);
            }
            $request->kode != null ? $find->kode = $request->kode : true;
            $request->name != null ? $find->name = $request->name : true;
            $request->atribut != null ? $find->attribute = $request->atribut : true;
            $request->bobot != null ? $find->bobot = $request->bobot : true;
            $request->tajar_id != null ? $find->tajar_id = $request->tajar_id : true;
            $find->save();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil update data kriteria',
            ],201);
        }
    }

    public function hapusData($id)
    {
        $hapus = MasterKriteria::where('id',$id)->delete();
        if($hapus)
        {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil hapus data kriteria',
            ],201);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat hapus data kriteria',
            ],400);
        }
    }

    public function supportTajar(Request $request)
    {
        $tajar = TahunAjar::all();
        $data = array();

        foreach($tajar as $t)
        {
            $item['id'] = $t->id;
            $item['periode'] = $t->periode;
            $data[] = $item;
        }

        return response()->json([
            'data' => $data,
        ], 200);
    }
    
}
