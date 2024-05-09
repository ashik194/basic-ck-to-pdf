<?php

namespace App\Http\Controllers;

use App\Models\Content;
// use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use PDF;

class ContentCreateController extends Controller
{
    //

    public function content_create()
    {
        return view("content");
    }

    public function content_show($id)
    {
        $content = Content::findOrFail($id);
        return view("single-content",compact('content'));
    }

    // public function generate_pdf($id)
    // {
    //     $content = Content::findOrFail($id);
    //     // dd($content);
    //     $pdf = Pdf::loadView('content-pdf', compact('content'))->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])->setPaper('a4', 'potrait');
    //     return $pdf->download('content-pdf-'.$id.'.pdf');
    // }

    public function mpdf($id)
    {
        $content = Content::findOrFail($id);


            $pathName = '/image/pattern.png';
            $path = public_path().$pathName;
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $bg = 'data:image/'.$type.';base64,'.base64_encode($data);


        $content['background'] = $bg;

        $data=array('content'=>$content);

        $pdf = PDF::loadView('single-content-pdf', $data);

        return $pdf->stream('content-pdf-'.$id.'.pdf');
    }

    public function all_PDF()
    {
        $contents = Content::latest()->get();
        ini_set("pcre.backtrack_limit", "5000000");
        $pathName = '/image/pattern.png';
        $path = public_path().$pathName;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $bg = 'data:image/'.$type.';base64,'.base64_encode($data);
        $bg = 'data:image/'.$type.';base64,'.base64_encode($data);


        $data = array('contents' => $contents);
        $data['content']['background'] = $bg;
        $pdf = PDF::loadView('content-pdf', $data);

        return $pdf->stream('All-content-pdf.pdf');
    }

    public function content_store(Request $request)
    {
        Content::create($request->all());
        return back()->with("Success");
        
    }


    public function imageupload(Request $request){
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $request->file('upload')->move(public_path('media'), $fileName);

            // $url = asset('media/' . $fileName);
            $pathName = '/media/' . $fileName;
            $path = public_path().$pathName;
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $url = 'data:image/'.$type.';base64,'.base64_encode($data);
            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);

         }
    }

}
