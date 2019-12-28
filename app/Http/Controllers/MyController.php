<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MyController extends Controller
{
    public function XinChao(){
        echo "Xin chao!!";
    }

    public function KhoaHoc($ten){
        echo "Khoa Hoc : ".$ten;
        //return redirect()->route('MyRoute'); ham chuyen trang
    }

    public function GetURL(Request $request){
//        return $request->path();//path() in ra ten duong dan
        //return $request->url(); //Tra ve 1 URL day du
//        if ($request->is('My*')){
//            echo "Duong dan co My";
//        }else{
//            echo "Duong dan ko co My";
//        } Ham tim xem trong duong dan co chu or ki tu can tim ko?
        if ($request->isMethod('get')){
            echo "dang su dung phuong thuc GET";
        }else{
            echo "Ko su dung phuong thuc GET";
        }//Kiem tra Phuong thuc nay co dang su dung k?

    }

    public function postForm(Request $request){
        echo $request->HoTen;
    }

    public function setCookie(){
        $response = new Response();//Khoi tao Response
        $response->withCookie(
          'KhoaHoc', //ten Cookie
            'Laravel - Tien Tu', //Gia tri
            0.1  //phut
        );
        echo "Da set cookie";
        return $response;
    }
    public function getCookie(Request $request){
        echo "Da thoat cookie";
        return $request->cookie('KhoaHoc');
    }

    public function postFile(Request $request){
        //Kiem tra co ton tai file?
        if($request->hasFile('myFile')){
            $file = $request->file('myFile');//gan file vao bien $file
            if ($file->getClientOriginalExtension() == 'jpg') {//Ham kiem tra duoi file
                $filename = $file->getClientOriginalName();//Ham gan ten file
                $file->move('imgs', $filename);//luu file vao thu muc imgs va ten theo bien $filename
            }else{
                echo "ban chi duoc phep upload file JPG";
            }
        }else{
            echo "chua co file";
        }
    }

    public function myJSON(){
        $array = ['PHP','MYSQL','HTML'];
        $array2 = ['KhoaHoc'=>'Laravel'];
        return response()->json($array2);
    }//Dang Json

    public function myView(){
        return view('Test');
    }
    public function myView2(){
    return view('Test2');
    }

    public function Name($ten){
        return view('Test',['name'=>$ten]);//name la ten tham so chuyen sang ,$ten la gia tri
    }

    public function blade($str){
        $bien = '<b>Nguyen Tien Tu</b>';
        if ($str == 'laravel')
        {
            return view('pages.laravel',['bien' => $bien]);
        }
        elseif ($str == 'php')
        {
            return view('pages.php',['bien' => $bien]);
        }
    }
}
