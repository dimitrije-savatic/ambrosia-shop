<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact');
    }

    public function contactStore(Request $request)
    {
        $request->validate([
           'name' => 'required|min:3',
            'email' => 'required|email',
            'message' => 'required|min:5'
        ]);
        try{
            DB::beginTransaction();
            Contact::create(['name' => $request->name, 'email' => $request->email, 'message' => $request->message]);
            DB::commit();
            return redirect()->back()->with('success', "Message successfully sent.");
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function contactDelete($id)
    {
        $contact = Contact::find($id);
        try{
            DB::beginTransaction();
            $contact->delete();
            DB::commit();
            Log::create([
                'first_name' => Auth::user()->first_name,
                'last_name' => Auth::user()->last_name,
                'message' => "Successfully deleted a message."
            ]);
            return redirect()->back()->with('success', "Message deleted successfully.");
        }catch (\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
