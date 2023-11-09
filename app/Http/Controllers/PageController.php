<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductType;
use App\Models\Slide;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function getIndex()
    {
        $slide       = Slide::all();
        $new_product = Product::where('new', 1)->paginate(4);
        $promotion   = Product::where('promotion_price', '<>', 0)->paginate(8);
        return view('page.home', ['slide' => $slide, 'new_product' => $new_product, 'promotion' => $promotion]);
    }
    public function getTypeProduct($type)
    {
        $productByType = Product::where('id_type', $type)->get();
        $productOthers = Product::where('id_type', '<>', $type)->paginate(3);
        $productType   = ProductType::all();
        $typeName      = ProductType::where('id', $type)->first();
        return view(
            'page.Type_Product',
            [
                'productByType' => $productByType,
                'productOthers' => $productOthers,
                'productType'   => $productType,
                'typeName'      => $typeName,
            ]
        );
    }
    public function getDetailProduct(Request $request)
    {
        $product        = Product::where('id', $request->id)->first();
        $similarProduct = Product::where('id_type', $product)->paginate(3);
        return view('page.Detail_Product', ['product' => $product, 'similarProduct' => $similarProduct]);
    }
    public function getContact()
    {
        return view('page.Contact');
    }
    public function getAbout()
    {
        return view('page.About');
    }
    public function getLogin()
    {
        return view('page.Login');
    }
    public function getSignup()
    {
        return view('page.Signup');
    }
    public function postSignup(Request $request)
    {
        $this->validate(
            $request,
            [
                'email'       => 'required|email|unique:users,email',
                'password'    => 'required|min:6|max:20',
                'fullname'    => 'required',
                're_password' => 'required|same:password',

            ],
            [
                'email.required'       => 'Vui lòng nhập email',
                'email.email'          => 'Email không đúng định dạng',
                'email.unique'         => 'Email đã tồn tại',
                'password.required'    => 'Vui lòng nhập mật khẩu',
                'password.min'         => 'Mật khẩu ít nhất 6 kí tự',
                're_password.required' => 'Vui lòng nhập lại mật khẩu',
                're_password.same'     => 'Mật khẩu không trùng khớp',
            ]
        );
        $user = new User();
        $user->full_name= $request->fullname;
        $user->email= $request->email;
        $user->password=Hash::make($request->password);
        $user->save();
        return redirect()->back()->with('success','Đã tạo tài khoản thành công');
    }
    public function postLogin(Request $request) {
        $this->validate(
            $request,
            [
                'email'=>'required|email',
                'password'=>'required|min:6|max:20',
            ],
            [
                'email.required'=>'Vui lòng nhập email',
                'email.email'=>'Email không đúng định dạng',
                'paword.required'=>'Vui lòng nhập mật khẩu',
                'password.min'=>'Mật khẩu ít nhát 6 kí tự',
                'password.max'=>'Mật khẩu tối đa 20 kí tự',
            ]
            );
        $credentials= array('email'=>$request->email, 'password'=>$request->password);
        if(Auth::attempt($credentials)) {
            return redirect()->back()->with(['flag'=>'success','msg'=>'Đăng nhập thành công']);
        }else {
            return redirect()->back()->with(['flag'=>'danger','msg'=>'Đăng nhập không thành công']);
        }
    }
    public function postLogout() {
        Auth::logout();
        return redirect()->route('trang-chu');
    }
    public function getSearch(Request $request) {
        $product= Product::where('name','like','%'.$request->search.'%')
                            ->orWhere('unit_price',$request->search)->get();
        return view('page.Search',compact('product'));
    }
}
