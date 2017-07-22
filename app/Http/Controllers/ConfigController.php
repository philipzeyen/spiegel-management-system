<?php

namespace App\Http\Controllers;

use App\Config;
use App\MaskeConfigRef;
use App\Stele;
use App\Maske;
use Illuminate\Http\Request;

class ConfigController extends Controller {

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
        $configs = Config::all();
        return view("config.home")->with(compact("configs"));
    }

    public function showCreateForm() {
        return view('config.create')
                ->withMasken(Maske::all());
    }

    public function createConfig(Request $request) {
        $this->validateFormInputs($request);
        
        $config = new Config();
        $config->config_name = $request->input('configName');
        $config->config_json = $this->buildConfigJson($request);
        $config->save();

        foreach($request->input("masks") as $maske) {
            MaskeConfigRef::updateOrCreate([
                'config_id' => $config->config_id,
                'masken_id' => Maske::where('name_maske', $maske)->first()->masken_id
            ]);
        }
        
        return redirect('config')->withStatus(['Es wurde eine neue Config angelegt.']);
    }

    public function showEditForm(Config $config) {
        return view("config.edit")
                ->withConfig($config)
                ->withJson(json_decode($config->config_json, true))
                ->withMasken(Maske::all());
    }

    public function updateConfig(Config $config, Request $request) {
        $this->validateFormInputs($request);

        $config->config_name = $request->input('configName');
        $config->config_json = $this->buildConfigJson($request);
        
        foreach($request->input("masks") as $maske) {
            MaskeConfigRef::updateOrCreate([
                'config_id' => $config->config_id,
                'masken_id' => Maske::where('name_maske', $maske)->first()->masken_id
            ]);
        }
        
        $config->save();

        return redirect('config')->withStatus(['Die Config wurde erfolgreich bearbeitet.']);
    }

    public function delete(Config $config) {
        if(MaskeConfigRef::where('config_id', '=', $config->config_id)->delete() && $config->delete()) {
            return redirect('config')->withStatus(['Das Löschen der Config ist wurde erfolgreich abgeschlossen']);
        }

        return redirect('config')->withErrors(['Beim Löschen der Config ist ein Fehler aufgetreten']);
    }

    /**
     * @param Request $request
     */
    private function buildConfigJson(Request $request)
    {
        $title = $request->input("title");
        $masks = $request->input("masks");
        $windowWidth = $request->input("windowWidth");
        $windowHeight = $request->input("windowHeight");
        $windowFullscreen = $request->input("windowFullscreen", false) == true;
        $windowHideCursor = $request->input("windowHideCursor", false) == true;
        $heartbeatInterval = $request->input("connectionHeartbeatInterval");
        $socialSharingUploadPath = $request->input("connectionSocialSharingUploadPath");

        return include 'StelenKonfiguration.boilerplate.php';
    }

    /**
     * @param Request $request
     */
    private function validateFormInputs(Request $request)
    {
        $this->validate($request, [
            'configName' => 'required|min:5',
            'title' => 'required|min:5',
            'masks' => 'required|min:>1',
            'windowWidth' => 'required|numeric|min:1',
            'windowHeight' => 'required|numeric|min:1',
            'windowHideCursor' => '',
            'windowFullscreen' => '',
            'connectionHeartbeatInterval' => 'required|numeric|min:1|max:300',
            'connectionSocialSharingUploadPath' => 'required'
        ]);
    }

}
