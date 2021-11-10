<?php

namespace App\Http\Controllers\Backend;

use App\Communicate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CommunicateController extends Controller
{
    public function viewmsg(){
        $this->data['contacts'] = Communicate::orderBy('id','DESC')->get();
        return view('backend.communicate.viewCouumucate',$this->data);

    }
    public function delete($id){
        $data = Communicate::find($id);
        $delete = $data->delete();
        if ($delete) {
            Session::flash('message','Message Deleted Successfully');
            return redirect()->back();
        }
    }
}
