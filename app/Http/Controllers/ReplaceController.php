<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\json_temp;
use Log;
use PDF;

class ReplaceController extends Controller
{
    public function index()
    {
        $data = json_temp::get();
        Log::info("Data :" . print_r($data, true));
        return view('home', ['records' => $data]);
    }
    //
    public function save(Request $r)
    {
        Log::info("Json : " . print_r($r->all(), true));
        // dd("hi");
        $html = $r->html;
        json_temp::insert([
            'tmp_name' => $r->tmp_name,
            'html' => $html,
            'json' => $r->json,
            // 'temp_id' => 1
        ]);
        // $json = json_temp::where('temp_id', '1')->pluck('json')->first();
        // return view('dynamicField', ['strJson' =>  $json, 'json' => json_decode($json), 'html' => $html]);
        // dd($json);
        return redirect('/');
    }
    public function getValue($id){
        // dd($id);
        $json = json_temp::where('id', $id)->pluck('json')->first();
        return view('dynamicField', ['id' => $id,'strJson' =>  $json, 'json' => json_decode($json)]);
        // dd($json);
    }
    public function getHtmlReplace(Request $r)
    {
        // dd("get it : ", $r->id);
        
        // $json = json_temp::where('temp_id', '1')->pluck('json')->first();
        // Log::info("Json : " . print_r(json_decode($json), true));
        // Log::info("Json : " . print_r($json, true));
        // Log::info("Json : " . print_r($r->strJson, true));
        // Log::info("Json : " . print_r(json_decode($r->strJson), true));
        $html = json_temp::where('id', $r->id)->pluck('html')->first();
        $json = json_temp::where('id', $r->id)->pluck('json')->first();
        $json = json_decode($json);
        Log::info("Json : " . print_r($r->all(), true));
        foreach ($json as $j) {
            $obj = $j->value;
            Log::info("Json : " . print_r($r->$obj, true));
            // dd("stop");
            if (str_contains($html, $j->value)) {

                $html = str_replace($j->value, $r->$obj, $html);
            }
        }

        // dd($html);
        // $pdf = PDF::loadView('pdf.invoice', $html);
        // return $pdf->download('invoice.pdf');
        // $data = compact(
        //     'html'
        // );
        $domPdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => TRUE])->loadView('pdfTemplate', ['html' => $html]);
        // ->setPaper(array(0, 0, 1080, 1080))->setWarnings(false);
        // $domPdf = PDF::loadHtml($html);
        return $domPdf->stream('Report-a-' . 'pdf');
        // dd($html);
    }
    public function saveJson(Request $r)
    {
        dd("In json save", $r->json);
        if (json_temp::where("temp_id", 1)->exists()) {
            json_temp::where("temp_id", 1)->update([
                'json' => $r->json,
                // 'temp_id' => 1
            ]);
        } else {
            json_temp::insert([
                'json' => $r->json,
                'temp_id' => 1
            ]);
        }
    }
    
    public function edit(Request $r, $id)
    {
        // dd("id", $id);
        $data = json_temp::where('id', $id)->get();
        return view('edit', ['record' => $data[0]]);
    }
    public function update(Request $r, $id)
    {
        Log::info("All request : " . print_r($r->all(), true));
        // dd("I am in update", $r->tmp_name);
        json_temp::where("id", $id)->update([
            'tmp_name' => $r->tmp_name,
            'html' => $r->html,
            'json' => $r->json
        ]);
        return redirect('/');
    }
    public function delete($id)
    {
        json_temp::where("id", $id)->delete();
        return redirect('/');
    }
}
