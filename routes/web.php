<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

    Route::get('/', function () {
        return view('welcome');
    });
    //Phuong thuc route (thuong dung get va post)
    Route::get('KhoaHoc',function () {
       return "Hello World!!!";
    });
    //Truyen tham so
    Route::get('HoTen/{ten}',function ($ten){
        echo "Ho ten cua ban la : ".$ten;
    });
    //Truyen tham so co dieu kien
    Route::get('Ngay/{ngay}',function ($ngay){
        echo "Hom nay la ngay : ".$ngay;
    })->where(['ngay'=>'[0-9]+']);//[a-zA-Z]+ , [0-9]{6,12}+ dieu kien so va chi dc viet so tu 6 den 12 so ,[0-9a-zA-Z]+

    //Dinh danh

    Route::get('Route1',['as'=>'MyRoute',function(){
        echo "Xin chao cac ban";
    }]);
        //Khi ma ghi duong dan /GoiTen thi trinh duyen se chuyen ve trang /Route1 vi do no dc dinh danh nho MyRoute
    Route::get('GoiTen',function (){
        return redirect()->route('MyRoute2');
    });
    //Dinh danh cach 2
    Route::get('Route2',function (){
        echo "Day la route 2";
    })->name('MyRoute2');

    //Nhom Route

    Route::group(['prefix'=>'MyGroup'],function (){
        Route::get('User1',function (){
            echo "User1";
        });
        Route::get('User2',function (){
            echo "User2";
        });
        Route::get('User3',function (){
            echo "User3";
        });

    });

    //Goi Controller

    Route::get('GoiController','MyController@XinChao');

    Route::get('ThamSo/{ten}','MyController@KhoaHoc');

    Route::get('MyRequest','MyController@GetURL');

    //Gui nhan du lieu voi request

    Route::get('getForm',function (){
        return view('postForm');
    });

    Route::post('postForm',['as'=>'postForm','uses'=>'MyController@postForm']);

    //Cookie
    Route::get('setCookie','MyController@setCookie');
    Route::get('getCookie','MyController@getCookie');

    //Upload File
    Route::get('uploadFile',function (){
       return view('postFile');
    });
    Route::post('postFile',['as'=>'postFile','uses'=>'MyController@postFile']);

    //JSON
    Route::get('myJSON','MyController@myJSON');

    //Lam viec voi view

    Route::get('myView','MyController@myView');

    //truyen tha so voi view

    Route::get('Name/{ten}','MyController@Name');
    //View-Share
    Route::get('myView2','MyController@myView2');
    View::share('KhoaHoc','Laravel');//Giup cho cac file view co the dung chung du lieu
    //Khoa hoc la ten bien , Laravel la gia tri

    //blade

    Route::get('blade',function (){
       return view('pages.laravel');
    });

    //Blade Template

    Route::get('BladeTemplate/{str}','MyController@blade');

    //Database
    Route::get('database',function (){
//        Schema::create('loaisanpham',function ($table){
//            $table->increments('id');
//            $table->string('ten',200);
//        });
//        Schema::create('theloai',function ($table){
//           $table->increments('id');
//           $table->string('ten',200)->nullable();
//           $table->string('nsx')->default('nha san xuat');
//        });
        Schema::create('sanpham',function ($table){
           $table->increments('id');
           $table->string('tensanpham',200);
           $table->string('loaisanpham',200);
        });
        echo "DA THUC HIEN LENH TAO BANG";
    });

    Route::get('lienketbang',function (){
       Schema::create('sanpham',function ($table){
           $table->increments('id');
           $table->string('ten');
           $table->float('gia');
           $table->integer('soluong')->default(0);
           $table->integer('id_loaisanpham')->unsigned();
           $table->foreign('id_loaisanpham')->references('id')->on('loaisanpham');
       });
    });
    Route::get('xoacot',function (){
        Schema::table('theloai',function ($table){
            $table->dropColumn('nsx');
        });
    });

    Route::get('themcot',function (){
        Schema::table('theloai',function ($table){
            $table->String('Email');
        });
    });

    Route::get('doiten',function (){
        Schema::rename('theloai','nguoidung');
    });

    Route::get('xoabang',function (){
        Schema::dropIfExists('nguoidung');
        echo "da xoa bang";
    });

    //Query Builder
    Route::get('qb/get',function (){
        $data = DB::table('users')->get();// giong select * from
        foreach ($data as $row){
            foreach ($row as $key=>$value){
                echo $key."=>".$value."<br>";
            }
            echo "<hr>";
        }
    });

    //Select * from users where id = 3;
    Route::get('qb/where',function (){
        $data = DB::table('users')->where('id','=',3)->get();// giong select * from
        foreach ($data as $row){
            foreach ($row as $key=>$value){
                echo $key."=>".$value."<br>";
            }
            echo "<hr>";
        }
    });
    //Select id,name,email from users where id = 3;
    Route::get('qb/select',function (){
        $data = DB::table('users')->select(['id','name','email'])->where('id',3)->get();// giong select * from
        foreach ($data as $row){
            foreach ($row as $key=>$value){
                echo $key."=>".$value."<br>";
            }
            echo "<hr>";
        }
    });
    //Select id,name as hoten,email from users where id = 3;
    Route::get('qb/raw',function (){
        $data = DB::table('users')->select(DB::raw('id,name as hoten,email'))->where('id',3)->get();// giong select * from
        foreach ($data as $row){
            foreach ($row as $key=>$value){
                echo $key."=>".$value."<br>";
            }
            echo "<hr>";
        }
    });
    //Select id,name as hoten,email from users where id >1 order by id desc;
    //skip(1) bo qua phan tu thu nhat - take(2) lay 2 phan tu tiep theo
    Route::get('qb/orderby',function (){
        $data = DB::table('users')->select(DB::raw('id,name as hoten,email'))->where('id','>',1)->skip(1)->take(2)->orderby('id','desc')->get();// giong select * from
        foreach ($data as $row){
            foreach ($row as $key=>$value){
                echo $key."=>".$value."<br>";
            }
            echo "<hr>";
        }
    });
    //count mang
    Route::get('qb/count',function (){
        $data = DB::table('users')->select(DB::raw('id,name as hoten,email'))->where('id','>',1)->skip(1)->take(2)->orderby('id','desc')->get();
        echo $data->count();
    });
    //update
    Route::get('qb/update',function (){
        $data = DB::table('users')->where('id',1)->update(['name'=>'TienTu','email'=>'tientu99865@gmail.com']);
        echo "Đã update";
    });
    //delete
    Route::get('qb/delete',function (){
        $data = DB::table('users')->where('id',9)->delete();
        echo "Đã xóa";
    });
    //truncate la xoa tat ca cac du lieu trong bang users
    Route::get('qb/truncate',function (){
        $data = DB::table('users')->truncate();
        echo "Đã xóa";
    });

    //Model
    Route::get('model/save',function (){
       $user = new App\User();

       $user->name = "Phuong";
       $user->email = "Phuong@gmail.com";
       $user->password = "MatKhau";

       $user->save();
       echo "Da thuc hien save";
    });
    Route::get('model/sanpham/save/{ten}/{soluong}',function ($ten,$soluong){
        $sanpham = new App\sanpham();

        $sanpham->ten = $ten;
        $sanpham->soluong = $soluong;

        $sanpham->save();
        echo "Da them san pham ".$ten." voi so luong la ".$soluong;
    });

    //Model query
    Route::get('model/query',function (){
       $user = App\User::find(3);
       echo $user->name;
    });

    //lam viec voi toJson
    Route::get('model/sanpham/all',function (){
       $sanpham = App\sanpham::all()->toJson();
       echo $sanpham;
    });
    //lam viec voi toArray
    Route::get('model/sanpham/array',function (){
        $sanpham = App\sanpham::all()->toArray();
        var_dump($sanpham);
    });
    //lam viec voi Querybulder
    Route::get('model/sanpham/delete',function (){
        App\sanpham::destroy(2);
        echo "Da Xoa";
    });
    //Tao cot
    Route::get('taocot',function (){
       Schema::table('sanpham',function ($table){
          $table->integer('id_loaisanpham')->unsigned();
       });
    });
    //lienketbang
    Route::get('lienket',function (){
        $data = App\sanpham::find(3)->LoaiSanPham->toArray();
        var_dump($data);
    });
//lienketbang
Route::get('lienketloaisanpham',function (){
    $data = App\LoaiSanPham::find(1)->sanpham->toArray();
    var_dump($data);
});

//Middleware

Route::get('diem',function (){
    echo "Ban da du co diem";
})->middleware('MyMiddle')->name('diem');
Route::get('loi',function (){
   echo "Ban chua du co diem";
})->name('loi');
Route::get('nhapdiem',function (){
   return view('nhapdiem');
})->name('nhapdiem');



?>
