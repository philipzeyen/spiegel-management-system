<?php

namespace App\Http\Controllers;

use App\Stele;
use App\Maske;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function registerStele($id)
    {
        date_default_timezone_set('Europe/Berlin');
        $newStele = new Stele();
        $newStele->stelen_id = $id;
        $newStele->name_stele = 'defaultName' . $id;
        $newStele->standort = 'defaultStandort';
        $newStele->letzteMeldung = date("Y-m-d H:i:s", time());

        try {
            if($newStele->saveOrFail()) {
                return $newStele;
            }
        } catch (\Throwable $e) {
            return [
                'status' => 400,
                'message' => "Beim Speichern der Stele $id ist ein Fehler aufgetreten"
            ];
        }
    }

    public function getConfig(Stele $stele) {
        if(!$this->checkIfConfigExists($stele)) {
            return json_encode([
                'status' => 404,
                'message' => 'Zu dieser Stele exisiert aktuell keine Config'
            ], JSON_PRETTY_PRINT);
        }
        
        return $stele->config->config_json;
    }

    public function getConfigPunkte(Stele $stele, Maske $maske) {
        if(!$this->checkIfConfigExists($stele)) {
            return json_encode([
                'status' => 404,
                'message' => 'Zu dieser Stele exisiert aktuell keine Config'
            ], JSON_PRETTY_PRINT);
        }
        
        $maskenRefs = $stele->config->maskenRefs;
        $masken = array();
        foreach($maskenRefs as $ref)
            $masken[] = $ref->maske;
        
        foreach($masken as $checkMaske) {
            if($checkMaske->name_maske === $maske->name_maske) {
                return $maske->punkte;
            }
        }

        return json_encode([
            'status' => 404,
            'message' => "Maske konnte nicht gefunden werden"
        ], JSON_PRETTY_PRINT);
    }

    public function getConfigTextur(Stele $stele, Maske $maske) {
        if(!$this->checkIfConfigExists($stele)) {
            return json_encode([
                'status' => 404,
                'message' => 'Zu dieser Stele exisiert aktuell keine Config'
            ], JSON_PRETTY_PRINT);
        }
        
        $maskenRefs = $stele->config->maskenRefs;
        $masken = array();
        foreach($maskenRefs as $ref)
            $masken[] = $ref->maske;
        
        foreach($masken as $checkMaske) {
            if($checkMaske->name_maske === $maske->name_maske) {
                return base64_encode(file_get_contents(public_path() . DIRECTORY_SEPARATOR . $maske->bilddatei));
            }
        }

        return json_encode([
            'status' => 404,
            'message' => "Maske konnte nicht gefunden werden"
        ], JSON_PRETTY_PRINT);
    }
    
    public function heartbeat(Stele $stele) {
        if(!$this->checkIfConfigExists($stele)) {
            return json_encode([
                'status' => 404,
                'message' => 'Zu dieser Stele exisiert aktuell keine Config'
            ], JSON_PRETTY_PRINT);
        }
        
        date_default_timezone_set('Europe/Berlin');
        
        $dateTime1 = new \DateTime($stele->letzteMeldung);
        $dateDiff = $dateTime1->diff(new \DateTime());
        $dateDiffSeconds = $dateDiff->format('%h') * 60 * 60 + $dateDiff->format('%i') * 60 + $dateDiff->format('%s');
        
        $config_json_decoded = json_decode($stele->config->config_json, true);
        if($dateDiffSeconds > ($config_json_decoded['Mirror']['connection']['interval'] + 5)) {
            $stele->letzteDowntime = date("Y-m-d H:i:s", time());
        }
        
        $stele->letzteMeldung = date("Y-m-d H:i:s", time());
        $stele->save();
        return $stele;
    }
    
    private function checkIfConfigExists($stele) {
        try {
            $response = $stele->config->config_json;
        } catch (\Exception $ex) {
            return false;
        }
        return true;
    }
}
