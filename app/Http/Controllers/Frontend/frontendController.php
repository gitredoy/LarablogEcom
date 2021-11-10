<?php

namespace App\Http\Controllers\Frontend;

use App\Communicate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class frontendController extends Controller
{
    public function index(){
        return view('frontend.singlePage.home');
    }
    public function aboutUs(){
        return view('frontend.singlePage.aboutUs');
    }
    public function contactUs(){
        return view('frontend.singlePage.contactUs');
    }
    public function contacStore(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'address' => 'required',
            'message' => 'required',
        ],[
            'name.required' => 'Name Cannot be empty ',
            'email.required' => 'Email  Cannot be empty ',
            'mobile.required' => 'Mobile Number  Cannot be empty ',
            'address.required' => 'Address  Cannot be empty ',
            'message.required' => 'Message  Cannot be empty ',
        ]);
       $contact = new Communicate();
       $contact -> name = $request ->name;
       $contact -> email = $request ->email;
       $contact -> mobile = $request ->mobile;
       $contact -> address = $request ->address;
       $contact -> message = $request ->message;
       $store = $contact->save();
       $ran = rand();


        $data = array(
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'mymessage' =>  $request ->message,
            'ran' => $ran
        );

        Mail::send('mail',$data,function ($message) use($data){
            $message->from('nasimredoyupwork@gmail.com','Wellbeing Tech Ltd');
            $message->to($data['email']);
            $message->subject('Thanks For Contact Us');
        });

       if ($store) {
           Session::flash('message','Thanks for your Query');
           return redirect()->back();
       }
    }

    public function singleProduct(){
        return view('frontend.singlePage.singleProduct');
    }
    public function cartProduct(){
        return view('frontend.singlePage.cartProduct');
    }


}
