<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Crypto;

class CryptoController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* http://domain/crypto/api */
    public function api(){
        // Get data all for response json format.
        $cryptos = Crypto::all()->toArray();
        $count_rec = count($cryptos);
        $data_api = (object)array(
            "returnCode"=> $count_rec > 0 ? "0000" : "1111", 
            "returnMsg"=> $count_rec > 0 ? "Found data." : "Not Found data.",
            "TotalRecord"=> $count_rec,
            "crypto_news"=> $cryptos
        );
        // Response json format.
        echo json_encode($data_api); 
    }

    // Index page.
    public function index(Request $request){
        $cryptos = Crypto::paginate(5);
        $page=1;
        if($request->get('page')){
            $page=$request->get('page');
        }
        return view('crypto.index', compact('cryptos'))->with('page', $page);
    }

    // Get data by id for edit.
    public function edit($id){
        $cryptos = Crypto::find($id);
        return view('crypto.edit', compact('cryptos', 'id'));
    }

    // Validate data for edit and pass to model.
    public function update(Request $request, $id){
        // Validate data input.
        $this->validate($request, 
            [   
                'headline' => 'required|max:255',
                'contents' => 'required|max:255',
                'thumbnails_img' => 'image|mimes:jpeg,png,jpg|max:1024'
            ]
        );
        // New object model and set new value.
        $cryptos = Crypto::find($id);
        $cryptos->headline = $request->get('headline');
        $cryptos->contents = $request->get('contents');
        $cryptos->imgpath = $request->get('thumbnails_img_old');
        if($request->file('thumbnails_img')){
            $image = $request->file('thumbnails_img');
            $image->move(public_path("images"), $cryptos->imgpath);
        }
        // Commit data to model.
        $cryptos->save();
        return redirect()->route('crypto.index')->with('success', 'Updateds');
    }

    // Create page.
    public function create(){
        return View('crypto.create');
    }

    // Validate data for new record.
    public function store(Request $request){
        // Validate data new input.
        $this->validate($request, [
            'headline' => 'required|max:255',
            'contents' => 'required|max:255',
            'thumbnails_img' => 'required|image|mimes:jpeg,png,jpg|max:1024'
        ]);
        $image = $request->file('thumbnails_img');
        $originalDate = date("Y-m-d H:i:s");
        $newDate = date("Y-m-d-H-i-s", strtotime($originalDate));
        // Create file name image format [_token]+"_"+Y-m-d-H-i-s." + [jpeg,png,jpg]
        $img_name_file 
            = $request->_token.'-'.$newDate.'.'
                .$image->getClientOriginalExtension();
        // Move file to path public/images.
        $image->move(public_path("images"), $img_name_file);
        $cryptos = new Crypto(
            [   'headline' => $request->get('headline'), 
                'contents' => $request->get('contents'),
                'imgpath' => $img_name_file
            ]);
        // Commit data to model.
        $cryptos->save();
        return redirect()->route('crypto.index')
                         ->with('success', 'Create Successful');
    }

    // Delete record by id from model.
    public function destroy($id){
        $cryptos = Crypto::find($id);
        $cryptos->delete();
        return redirect()->route('crypto.index')
                         ->with('success', 'Deleted');
    }
}
