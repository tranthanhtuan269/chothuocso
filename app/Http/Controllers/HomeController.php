<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Company;
use App\Category;
use Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function welcome()
    {
        return view('welcome');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    
    public function postImage(Request $request){
        $img_file = '';
        if ($request->hasFile('input_file_name')) {
            $file_img = $request->file('input_file_name');
            $filename = $file_img->getClientOriginalName();
            $extension = $file_img->getClientOriginalExtension();
            $img_file = date('His') . $filename;
            $destinationPath = base_path('../../images');
            $file_img->move($destinationPath, $img_file);
            return \Response::json(array('code' => '200', 'message' => 'success', 'image_url' => $img_file));
        }
        return \Response::json(array('code' => '404', 'message' => 'unsuccess', 'image_url' => ""));
    }

    public function postImages(Request $request){
        $picture = '';
        $allPic = '';
        if (count($request->files) > 0) {
            $files = $request->files;
            foreach ($files as $file) {
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $picture = date('His') . $filename;
                $allPic .= $picture . ';';
                $destinationPath = base_path('../../images');
                $file->move($destinationPath, $picture);
            }
            return \Response::json(array('code' => '200', 'message' => 'success', 'images_url' => $allPic));
        }
        return \Response::json(array('code' => '404', 'message' => 'unsuccess', 'images_url' => ""));
    }
    
    public function action(){
        $user = User::findOrFail(1);
        \Mail::send('emails.reminder', ['user' => $user], function ($m) use ($user) {
            $m->from('tuantt6393@gmail.com', 'Your Application');

            $m->to($user->email, $user->name)->subject('Your Reminder!');
        });
    }

    public function privacypolicy(){
        return view('home.privacypolicy');
    }

    public function termsofservice(){
        return view('home.termsofservice');
    }

    public function ajaxpro(Request $request){
        if(isset($_POST["image"])){
            $data = $_POST["image"];
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            $imageName = time().'.png';
            $destinationPath = base_path('../../images');
            file_put_contents($destinationPath.'/'.$imageName, $data);
            return \Response::json(array('code' => '200', 'message' => 'success', 'image_url' => $imageName));
        }
        return \Response::json(array('code' => '404', 'message' => 'unsuccess', 'image_url' => ""));
    }

    public function updateSlug(){
        $companies = \App\Company::select('id')->get();
        foreach($companies as $c){
            $company = \App\Company::find($c->id);
            $company->slug = null;
            $company->save();
        }
        $jobs = \App\Job::select('id')->get();
        foreach($jobs as $j){
            $job = \App\Job::find($j->id);
            $job->slug = null;
            $job->save();
        }
        $cities = \App\City::select('id')->get();
        foreach($cities as $ci){
            $city = \App\City::find($ci->id);
            $city->slug = null;
            $city->save();
        }
        $districts = \App\District::select('id')->get();
        foreach($districts as $di){
            $district = \App\District::find($di->id);
            $district->slug = null;
            $district->save();
        }
        $jobTypes = \App\JobType::select('id')->get();
        foreach($jobTypes as $jt){
            $jobType = \App\JobType::find($jt->id);
            $jobType->slug = null;
            $jobType->save();
        }
        $companyTypes = \App\CompanyType::select('id')->get();
        foreach($companyTypes as $ct){
            $companyType = \App\CompanyType::find($ct->id);
            $companyType->slug = null;
            $companyType->save();
        }
        $posts = \App\Post::select('id')->get();
        foreach($posts as $p){
            $post = \App\Post::find($p->id);
            $post->slug = null;
            $post->save();
        }
        $categories = \App\Category::select('id')->get();
        foreach($categories as $ca){
            $category = \App\Category::find($ca->id);
            $category->slug = null;
            $category->save();
        }
    }
}
