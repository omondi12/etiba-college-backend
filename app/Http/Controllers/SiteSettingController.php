<?php
namespace App\Http\Controllers;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::all()->groupBy('group')->map(fn($g) => $g->pluck('value','key'));
        return response()->json(['status'=>true,'data'=>$settings]);
    }
    public function update(Request $request)
    {
        $data = $request->validate(['settings'=>'required|array','settings.*.key'=>'required|string','settings.*.value'=>'nullable|string','settings.*.group'=>'sometimes|string']);
        foreach ($data['settings'] as $s) {
            SiteSetting::set($s['key'], $s['value'], $s['group'] ?? 'general');
        }
        return response()->json(['status'=>true,'message'=>'Settings saved']);
    }
}
