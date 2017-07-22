<?php

namespace App\Http\Controllers;

use App\Stele;
use App\Config;
use App\User;
use Illuminate\Http\Request;

class SteleController extends Controller
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
     * Show the application/stelen dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $stelen_aktiv = Stele::where([["status", 1], ["loesch_markiert", 0]])->orderBy("stelen_id", "asc")->get();
        $stelen_inaktiv = Stele::where([["status", 0], ["loesch_markiert", 0]])->orderBy("stelen_id", "asc")->get();

        return view('stele.home')
                ->with(compact("stelen_aktiv"))
                ->with(compact("stelen_inaktiv"));
    }

    public function showCreateForm() {
        $configs = Config::all();
        $users = User::all();
        
        return view('stele.create')
                ->with(compact('configs', 'users'));
    }
    
    public function createStele(Request $request) {
        $this->validateFormInput($request);
        
        $stele = new Stele();
        
        $stele->name_stele = $request->input('stele_name');
        $stele->standort = $request->input('stele_standort');
        $stele->config_id = $request->input('stele_config_id');
        $stele->user_id = $request->input('stele_user_id') ?? null;
        
        $stele->save();

        return redirect('stele')->withStatus(['Die Stele "' . $stele->name_stele . '" wurde erfolgreich erstellt.']);
    }

    public function showEditForm(Stele $stele) {
        $configs = Config::all();
        $users = User::all();
        
        return view('stele.edit')
                ->with(compact('stele', 'users', 'configs'));
    }

    public function updateStele(Stele $stele, Request $request) {
        $this->validateFormInput($request);
        
        $stele->name_stele = $request->input('stele_name');
        $stele->standort = $request->input('stele_standort');
        $stele->config_id = $request->input('stele_config_id');
        $stele->user_id = $request->input('stele_user_id') ?? null;
        
        $stele->save();
        
        return redirect('stele')->withStatus(['Die Stele "' . $stele->name_stele . '" wurde erfolgreich bearbeitet.']);
    }

    public function delete(Stele $stele) {
        if($stele->delete())
            return redirect()->withStatus(['Das Löschen der Stele "' . $stele->name_stele . '" wurde erfolgreich abgeschlossen.']);
        
        return redirect()->withErrors(['Beim Löschen der Stele "' . $stele->name_stele . '" ist ein Fehler aufgetreten.']);
    }
    
    private function validateFormInput(Request $request) {
        $this->validate($request, [
            'stele_name' => 'required|min:5',
            'stele_standort' => 'required|min:5',
            'stele_user_id' => 'exists:users,id',
            'stele_config_id' => 'required|exists:config_db,config_id'
        ]);        
    }
}
