<?php

namespace App\Http\Controllers;

use App\Maske;
use App\MaskeConfigRef;
use Illuminate\Http\Request;

class MaskeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the config dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $masken = Maske::all();
        return view('maske.home')->with(compact('masken'));
    }

    public function showCreateForm() {
        return view('maske.create');
    }

    public function createMaske(Request $request) {
        $this->validate($request, [
            'maske_name' => 'required|min:5',
            'maske_bilddatei' => 'required|mimes:png|file',
            //'maske_json_datei' => 'required|file'
        ]);
        
        $maske = new Maske();
        
        $maske->name_maske = $request->input('maske_name');
        
        if($request->hasFile('maske_json_datei')) {
            $fileJson = $request->file('maske_json_datei');
            if($fileJson->isValid()) {
                $maske->punkte = json_encode(json_decode(file_get_contents($fileJson->getRealPath()), true), JSON_PRETTY_PRINT);
            }
        } else {
            $maske->punkte = $this->getMaskPoints();
        }
        
        if($request->hasFile('maske_bilddatei')) {
            $fileMask = $request->file('maske_bilddatei');
            if($fileMask->isValid()) {
                $fileName = $maske->name_maske .".". $fileMask->getClientOriginalExtension();
                $filePath = public_path('images' . DIRECTORY_SEPARATOR);
                $fileMask->move($filePath, $fileName);
                $maske->bilddatei = "/images/$fileName";
            }
        }
        
        $maske->save();
        
        return redirect('maske/edit/' . $maske->masken_id)
                ->withStatus(['Das Erstellen der Maske "' . $maske->name_maske . '" wurde erfolgreich abgeschlossen.']);
    }

    public function showEditForm(Maske $maske) {
        return view('maske.edit')
                ->with(compact('maske'));
    }

    public function updateMaske(Maske $maske, Request $request) {
        $this->validate($request, [
            'maske_name' => 'required|min:5',
            'maske_bilddatei' => 'nullable|mimes:png|file',
            'maske_json' => 'required'
            //'maske_json_datei' => 'nullable|file'
        ]);
        
        if($maske->name_maske !== $request->input('maske_name')) {
            
            foreach($maske->configRefs as $ref) {
                $json_decoded = json_decode($ref->config->config_json, true);
                $json_decoded['Mirror']['masks'] = array_diff($json_decoded['Mirror']['masks'], [$maske->name_maske]);
                $json_decoded['Mirror']['masks'][] = $request->input('maske_name');
                $ref->config->config_json = json_encode($json_decoded, JSON_PRETTY_PRINT);
                $ref->config->save();
            }
            
            if(is_file(public_path() . DIRECTORY_SEPARATOR . $maske->bilddatei)
                    && file_exists(public_path() . DIRECTORY_SEPARATOR . $maske->bilddatei)) {
                $pathinfo = pathinfo(public_path() . DIRECTORY_SEPARATOR . $maske->bilddatei);
                rename(
                    public_path() . DIRECTORY_SEPARATOR . $maske->bilddatei,
                    $pathinfo['dirname'] . DIRECTORY_SEPARATOR . $request->input('maske_name') . '.' . $pathinfo['extension']
                );
            }
            
            $maske->name_maske = $request->input('maske_name');
        }
        
        if(md5($request->input('maske_json')) != md5($maske->punkte)) {
            $maske->punkte = $request->input('maske_json');
        }
        
//        if($request->hasFile('maske_json_datei')) {
//            $fileJson = $request->file('maske_json_datei');
//            if($fileJson->isValid()) {
//                $maske->punkte = json_encode(json_decode(file_get_contents($fileJson->getRealPath()), true), JSON_PRETTY_PRINT);
//            }
//        }
        
        if($request->hasFile('maske_bilddatei')) {
            $fileMask = $request->file('maske_bilddatei');
            if($fileMask->isValid()) {
                if(is_file(public_path() . DIRECTORY_SEPARATOR . $maske->bilddatei)
                        && file_exists(public_path() . DIRECTORY_SEPARATOR . $maske->bilddatei)) {
                    unlink(public_path() . DIRECTORY_SEPARATOR . $maske->bilddatei);
                }
                
                $fileName = $maske->name_maske .".". $fileMask->getClientOriginalExtension();
                $filePath = public_path('images' . DIRECTORY_SEPARATOR);
                $fileMask->move($filePath, $fileName);
                $maske->bilddatei = "/images/$fileName";
            }
        }
        
        $maske->save();
        
        return redirect('maske')->withStatus(['Das Ändern der Maske "' . $maske->name_maske . '" wurde erfolgreich abgeschlossen.']);
    }

    public function delete(Maske $maske) {

        if($maske->configRefs->count() > 0) {
            foreach($maske->configRefs as $ref) {
                $json_decoded = json_decode($ref->config->config_json, true);
                $json_decoded['Mirror']['masks'] = array_diff($json_decoded['Mirror']['masks'], [$maske->name_maske]);
                $ref->config->config_json = json_encode($json_decoded, JSON_PRETTY_PRINT);
                $ref->config->save();
            }
            MaskeConfigRef::where('masken_id', '=', $maske->masken_id)->delete();
        }
        
        if(is_file(public_path() . DIRECTORY_SEPARATOR . $maske->bilddatei) 
                && file_exists(public_path() . DIRECTORY_SEPARATOR . $maske->bilddatei)) {
            unlink(public_path() . DIRECTORY_SEPARATOR . $maske->bilddatei);
        }
        
        if($maske->delete()) {
            return redirect('maske')->withStatus(['Das Löschen der Maske ist wurde erfolgreich abgeschlossen']);
        }

        return redirect('maske')->withErrors(['Beim Löschen der Maske ist ein Fehler aufgetreten']);
    }
    
    private function getMaskPoints() {
        return json_encode(json_decode('{"uv":[0.10191553967007,0.42812687457542,0.1162513335287,0.46707067463465,0.14073494280588,0.53483436585967,0.17965193757793,0.59218433770266,0.21642122051227,0.65135408681014,0.25216985447787,0.71587501685821,0.3188779004622,0.77330669826101,0.42070052056825,0.80942396385169,0.53554616921888,0.82556100549369,0.65750335792765,0.80924985887115,0.75377175396351,0.77750256367985,0.82101629300692,0.71323247800426,0.83590111748015,0.65016060039915,0.86457680568633,0.59008642984408,0.90279763684599,0.5311109645987,0.91713553065197,0.48112862050346,0.91918378699486,0.43094739514085,0.27262913209996,0.3678263128738,0.32002822428651,0.3530144670914,0.36742731647305,0.35005209793491,0.41482638380815,0.3604203899826,0.46636207406606,0.37739783731,0.57402505781441,0.37880258070638,0.62940397480023,0.358752078584,0.68287330652293,0.35206859444376,0.73061373334754,0.35779728448503,0.78408301536734,0.36734515092216,0.52419000184497,0.41357993874057,0.52632956240775,0.45316079006673,0.53060868353331,0.49381139547474,0.53916692578443,0.54301998383573,0.45640141490228,0.55661051026706,0.49482761842808,0.56717743507373,0.53517513710047,0.56717743507373,0.57744392121654,0.56429553293509,0.60626359871234,0.55564987622085,0.30270554732034,0.43068752991368,0.34461594870502,0.41463582605404,0.41364715774983,0.42293406803406,0.42967323526886,0.44522581765644,0.38419744634473,0.45038723758769,0.33659524327381,0.44461560529601,0.62575782005484,0.44478081367606,0.63985942629339,0.42067117545298,0.69816315989541,0.41173399354223,0.7373342607231,0.4258352295732,0.709131048246,0.44008040166574,0.66839311332578,0.44977968426707,0.33222121446839,0.69838792851726,0.3903494719962,0.69965099727846,0.44694782468317,0.70417872080609,0.53476136049153,0.70291599995664,0.61224330442348,0.69730080369872,0.68084150183861,0.69589911695558,0.73312169177524,0.69299474965816,0.67720513856372,0.72447892416234,0.60893965233421,0.73358074288383,0.53308910655665,0.73585623484046,0.45875559256985,0.73206379794776,0.39307560128575,0.72333762451399,0.36751675683435,0.70325615824577,0.44275439135026,0.71579276057994,0.53452035114897,0.71606467846419,0.6148940592713,0.71606467846419,0.69996513838877,0.70156749400973,0.6148940592713,0.71688038241527,0.53452035114897,0.71606467846419,0.44221059196547,0.71633659634844,0.097029546184726,0.36786776407385,0.17148980255624,0.3019593868136,0.26608649138907,0.26412933924729,0.38705971186635,0.2431690354706,0.64712728195936,0.2392563205154,0.76251344960365,0.25848166294232,0.83538361092732,0.28333045210584,0.89169381107492,0.33975480473527]}', true), JSON_PRETTY_PRINT);
    }
}
