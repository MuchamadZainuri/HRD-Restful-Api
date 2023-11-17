<?php

namespace App\Http\Controllers;

use App\Models\employees;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    /**
     *  method untuk menampilkan semua data karyawan
     */
    public function index()
    {
        // menggunakan eloquent all() untuk mengambil semua data
        $employees = employees::all();

        // cek isi data
        if($employees->isEmpty()){
        $data = ["message" => "Data is empty"];

        // mengirim data (json) dan kode 204
        return response()->json($data, 204);
        }else{

            // membuat response data
            $data = [
                "message" => "Get All Resource",
                "data" => $employees
            ];

            // mengirim respone data (json) dan kode 200
            return response()->json($data, 200);
        }
    }

    /**
     * method untuk menambahkan data karyawan baru
     */
    public function store(Request $request)
    {
        // memvalidasi inputan
        $request->validate([
            'name' => "required",
            'gender' => "required",
            'phone' => "required",
            'address' => "string",
            'email' => "email",
        ],[
            "name.required" => "nama tidak boleh kosong",
            "gender.required" => "gender tidak boleh kosong",
            "phone.required" => "phone tidak boleh kosong",
            "address.string" => "address harus berupa string",
            "email.email" => "email harus berupa email",
        ]);

        // menangkap semua inputan
        $input = [
            "name" => $request->name,
            "gender" => $request->gender,
            "phone" => $request->phone,
            "address" => $request->address,
            "email" => $request->email,
            "employee_statuses_id" => 1,
            "hired_date_id" => 1,
        ];

        // menambahkan data baru menggunakan eloquent create()
        $employees = employees::create($input);

        // membuat response data
        $data = [
            "message" => "Resource is added successfully",
            "data" => $employees
        ];

        // mengirim respone data (json) dan kode 201
        return response()->json($data, 201);
    }

    /**
     * method untuk menampilkan data siswa berdasarkan id
     */
    public function show($id)
    {
        // mencari data berdasarkan id menggunakan eloquent find()
        $employees = employees::find($id);

        // jika data tidak ditemukan maka tampilkan response pesan dan kode status 404
        if(!$employees){
            $data = [
                "message" => "Resource not found"
            ];

            return response()->json($data, 404);
        }else{
            // jika data di temukan maka tampilkan response pesan, data dan kode 200
            $data = [
                "message" => "Get Detail Resource",
                "data" => $employees
            ];
            return response()->json($data, 200);
        }
    }


    /**
     * method untuk mengupdate data karyawan berdasarkan id
     */
    public function update(Request $request, $id)
    {
        // mencari data berdasarkan id menggunakan eloquent find()
        $employees = employees::find($id);

        // jika data tidak ditemukan
        if(!$employees){

            // membuat response data
            $data = [
                "message" => "Resource not found"
            ];

            // mengirim respone data (json) dan kode 404
            return response()->json($data, 404);
        }else{
            // jika data di temukan maka lakukan validasi
            $employees->update([
                "name" => $request->name ?? $employees->name,
                "gender" => $request->gender ?? $employees->gender,
                "phone" => $request->phone ?? $employees->phone,
                "address" => $request->address ?? $employees->address,
                "email" => $request->email ?? $employees->email,
                "employee_statuses_id" => $request->employee_statuses_id ?? $employees->employee_statuses_id,
                "hired_date_id" => $request->hired_date_id ?? $employees->hired_date_id,
            ]);

            // membuat response data
            $data = [
                "message" => "Resource is update successfully",
                "data" => $employees
            ];

            // mengirim respone data (json) dan kode 200
            return response()->json($data, 200);
        }
    }

    /**
     * method untuk menghapus data karyawan berdasarkan id
     */
    public function destroy($id)
    {
        // mencari data berdasarkan id menggunakan eloquent find()
        $employees = employees::find($id);

        // jika data ditemuakan
        if($employees){

            // hapus data menggunakan eloquent delete()
            $employees->delete();

            // membuat response data
            $data = [
                "message" => "Resource is delete successfully",
                "data" => $employees
            ];

            // mengirim respone data (json) dan kode 200
            return response()->json($data, 200);
        }
        // jika data tidak ditemukan
        else{
            // membuat response data
            $data = [
                "message" => "Resource not found",
            ];
            // mengirim respone data (json) dan kode 404
            return response()->json($data, 404);
        }

    }

    /**
     * method untuk mencari data karyawan berdasarkan name
     */
    public function search($name)
    {
        // mencari data berdasarkan name menggunakan eloquent where()
        $employees = employees::where("name", "like", "%".$name."%")->get();

        // jika data tidak ditemukan
        if($employees->isEmpty()){

            // membuat response data
            $data = [
                "message" => "Resource not found"
            ];

            // mengirim respone data (json) dan kode 404
            return response()->json($data, 404);
        }
        // jika data ditemukan
        else{

            // membuat response data
            $data = [
                "message" => "Get searched Resource",
                "data" => $employees
            ];

            // mengirim respone data (json) dan kode 200
            return response()->json($data, 200);
        }
    }

    /**
     *  method untuk mencari data karyawan yang memiliki status = active
     */
    public function active(){
        // mencari data berdasarkan status 1/active menggunakan eloquent where()
        $active = employees::where("employee_statuses_id", 1)->get();

        // membuat response data
        $data = [
            "message" => "Get All Resource",
            "data" => $active
        ];

        // mengirim respone data (json) dan kode 200
        return response()->json($data, 200);

        }
    /**
     *  method untuk Mencari semua data karyawan yang memiliki status = inactive
     */
    public function inactive(){
        // mencari data berdasarkan status 2/inactive menggunakan eloquent where()
        $inactive = employees::where("employee_statuses_id", 2)->get();

        // membuat response data
        $data = [
            "message" => "Get All Resource",
            "data" => $inactive
        ];

        // mengirim respone data (json) dan kode 200
        return response()->json($data, 200);
    }

    /**
     *  method untuk Mencari semua data karyawan yang memiliki status = terminated
     */
    public function terminated(){
        // mencari data berdasarkan status 3/terminated menggunakan eloquent where()
        $terminated = employees::where("employee_statuses_id", 3)->get();

        // membuat response data
        $data = [
            "message" => "Get All Resource",
            "data" => $terminated
        ];

        // mengirim respone data (json) dan kode 200
        return response()->json($data, 200);

    }
}
