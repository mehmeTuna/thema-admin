<?php

namespace App\Http\Controllers;

use App\About;
use App\Admin;
use App\Http\Requests\SiteUpdateDataRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    public function loginPage()
    {
        return view('yonetim.loginPage');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|email',
            'password' => 'required|min:3|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'text' => 'Gecerli bir email ve parola giriniz',
            ]);
        }

        $admin = Admin::where('username', $request->username)->get();

        if (!isset($admin[0])) {
            return response()->json([
                'status' => false,
                'text' => 'Kullanıcı adı ve parola hatalı',
            ]);
        }

        if (!Hash::check($request->password, $admin[0]->password)) {
            return response()->json([
                'status' => false,
                'text' => 'Parola Hatalı',
            ]);
        }

        session()->put('admin', $admin[0]->id);

        return response()->json([
            'status' => true,
            'text' => 'is login',
            'url' => '/yonetim',
        ]);
    }

    public function logout()
    {
        if (session()->has('admin')) {
            session()->forget('admin');
            return response()->json([
                'status' => true,
                'text' => 'is logut',
            ]);
        }

        return response()->json([
            'status' => true,
            'text' => 'Ooooops',
        ]);
    }

    public function home()
    {
        return view('yonetim.home');
    }

    public function newAbout(SiteUpdateDataRequest $request)
    {

        $about = About::where('id', 1)->update((array) $request->all());

        return response()->json([
            'status' => true,
            'data' => $this->getAboutDAta(),
        ]);
    }

    public function galleryUpdate(Request $request)
    {
        $data = (array) $request->all();
        $gallery = [];
        foreach ($data as $key => $value) {
            $image = $request->file($key);
            if ($image == null) {
                continue;
            }
            $name = time() . rand(1, 100) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            array_push($gallery, ['url' => '/public/images/' . $name]);
        }

        $about = About::where('id', 1)->update(['gallery' => json_encode($gallery)]);

        return response()->json([
            'status' => true,
            'data' => $this->getAboutDAta(),
        ]);
    }

    public function logoUpdate(Request $request)
    {
        $data = (array) $request->all();
        $gallery = [];
        foreach ($data as $key => $value) {
            $image = $request->file($key);
            if ($image == null) {
                continue;
            }
            $name = time() . rand(1, 100) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            array_push($gallery, ['url' => '/public/images/' . $name]);
        }

        $about = About::where('id', 1)->update(['logo' => json_encode($gallery)]);

        return response()->json([
            'status' => true,
            'data' => $this->getAboutDAta(),
        ]);
    }

    public function sliderUpdate(Request $request)
    {
        $data = (array) $request->all();
        $gallery = [];
        foreach ($data as $key => $value) {
            $image = $request->file($key);
            if ($image == null) {
                continue;
            }
            $name = time() . rand(1, 100) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            array_push($gallery, ['url' => '/public/images/' . $name]);
        }

        $about = About::where('id', 1)->update(['slider' => json_encode($gallery)]);

        return response()->json([
            'status' => true,
            'data' => $this->getAboutDAta(),
        ]);
    }

    public function getAboutDAta()
    {
        return About::where('id', 1)->first();
    }

    public function getAbout()
    {
        $about = About::where('id', 1)->first();

        return response()->json([
            'status' => true,
            'data' => $about,
        ]);

    }

}