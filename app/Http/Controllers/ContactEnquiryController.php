<?php
namespace App\Http\Controllers;
use App\Models\ContactEnquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactEnquiryController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);
        ContactEnquiry::create($data);
        return response()->json(['status'=>true,'message'=>'Message received. We will get back to you shortly.']);
    }
    public function index()
    {
        return response()->json(['status'=>true,'data'=>ContactEnquiry::orderBy('created_at','desc')->get()]);
    }
    public function markRead($id)
    {
        $e = ContactEnquiry::findOrFail($id);
        $e->update(['is_read'=>true]);
        return response()->json(['status'=>true,'data'=>$e]);
    }
    public function destroy($id)
    {
        ContactEnquiry::findOrFail($id)->delete();
        return response()->json(['status'=>true,'message'=>'Deleted']);
    }
}
