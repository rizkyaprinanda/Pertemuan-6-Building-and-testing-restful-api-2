<?php

namespace App\Http\Controllers;
#mengimport model Student
# digunakan untuk berinteraksi dengan database student
use App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Response;


class StudentController extends Controller
{
    // membuat methode index
    
    public function index(){
        #memanggil methode getAllStudents dari model Student
        $students = Student::all();
        if($students)
        {
            $data = [
                'message'=>'Get all students',
                'data' => $students,
            ];
            return response()->json($data, 200);
        }else{
            $data = [
                'message'=>'Student not found',
            ];
            return response()->json($data, 404);
        }        
    }

    # mendapatkan detail resource
    #membuat method show
    public function show($id)
    {
        #cari data Student 
        $student = Student::find($id);
        if($student)
        {
            $data = [
                'message'=>'Get detail data student',
                'data'=>$student, 
            ];  
            # mengembalikan data json status code 200
            return response()->json($data, 200);

        }else{
            $data = [
                'message'=>'Student not found',
            ];
            return response()->json($data, 404);
        }
        
    }

    # membuat methode store untuk menambahkan resource student
    public function store(Request $request){
        
        $random = Str::random(10);
        $ri = random_int(01, 99);
        $jrsn = ["TeknologiInformasi", "Sistem Informasi","Manajemen Bisnis","Akuntansi","Kedokteran Gigi",
        "Keperawatan"];
        $rb = Arr::random($jrsn);
        $ar_nama = ["Ari", "Ayu", "Aulia", "Anggi", "Agus", "Ade ", "Arya", "Amel", "Andi",
        "Bayu", "Bagas", "Budi", "Bagus", "Bastian", "Ben",
        "Chika", "Cinta", "Citra", "Cakra", "Candra",
        "Darius", "Dimas", "Deo", "Dean", "Dinda", "Dika", "Dodi",
        "Ernes", "Erwin", "Eka", "Elin", "Elsa", "Ema", "Ela",
        "Fikri", "Fitri", "Fika", "Fani", "Fina", "Farid", "Fadel",
        "Galih", "Gading", "Guntur", "Gilang", "Geri", "Gibran",
        "Hamidah", "Hilda", "Hilmi", "Hisyam", "Haikal", "Harun",
        "Ita", "Ilham", "Indra", "Ikbal", "Irwan", "Ivan", "Irfan", "Ian",
        "Joko", "Josua", "Jonathan", "Jeri", "Jefri",
        "Karin", "Kirana", "Keisya", "Kevin", "Keyla",
        "Luna", "Lala", "Larisa", "Latif", "Lukman",
        "Mila", "Monika", "Maya", "Mira", "Malik",
        "Nila", "Nanda", "Naila", "Nisa", "Niko", "Nida",
        "Oki", "Okta", "Omar", "Oskar", "Olivia",
        "Putra", "Putri", "Paul", "Pinkan", "Pedro",
        "Qiqi", "Qafi", "Qori", "Qamar", "Queen",
        "Rafi", "Rafa", "Ririn", "Riska", "Rian",
        "Salsa", "Sinta", "Syifa", "Syahrul", "Samuel",
        "Tika", "Tristan", "Tobi", "Toni", "Tina",
        "Ulfa", "Usman", "Ulya", "Utari", "Umi",
        "Vania", "Virza", "Vincent", "Valdo", "Vino",
        "Wisnu", "Wulan", "Winda", "William", "Wira",
        "Yuda", "Yuli", "Yolanda", "Yusron", "Yosep",
        "Zulkifli", "Zulkarnain", "Zidan"];
        $nama_depan = Arr::random($ar_nama);
        $nama_belakang = Arr::random($ar_nama);
        $random_email = Str::of($nama_depan.$nama_belakang)->lower();
        # menangkap data request
        $input = [
            'nama' => $request->nama ?? $nama_depan.' '.$nama_belakang ,
            'nim' => $request->nim ?? '011'.$ri.'22'.random_int(001, 999) ,
            'email' => $request->email ?? Str::of($nama_depan.$nama_belakang.'@gmail.com')->lower(),
            'jurusan' => $request->jurusan ?? $rb,
        ];
       
        #mengguanakan model Student untuk insert data
        $student = Student::create($input);
        # mengembalikan data (json) status code 201
        return response()->json($student, 200);

        
        $data = [
            'message'=>'Student is created succesfully',
            'data'=>$student,
        ];


    }
    # membuat methode store untuk menambahkan resource student
    public function update(Request $request, $id){
        $student = Student::find($id);

        if ($student) {
            # mendapatkan data request
            $input = [
                'nama' => $request->nama ?? $student->nama,
                'nim' => $request->nim ?? $student->nim,
                'email' => $request->email ?? $student->email,
                'jurusan' => $request->jurusan ?? $student->jurusan,
            ];
            # mengupdate data
            $student->update($input);


        $data = [
            'message'=>'Student is change succesfully',
            'data'=>$student,
        ];
        return response()->json($data, 200);

    }   else {
        $data = [
            'message'=>'Student not found',
            'data'=>$student,
        ];
        return response()->json($data, 404);

    }

        # mengembalikan data (json) status code 201
    }

    public function destroy($id)
    {
        $student = Student::find($id);
        if ($student){
        $student->delete();
        $data = [
            'message'=>'Student has been deleted', 
        ];
        return response()->json($data, 201);
    }   else {
        $data = [
            'message'=>'Student not found',
        ];
        return response()->json($data, 404);
        }   
    }   
}