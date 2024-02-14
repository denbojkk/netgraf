<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Pet extends Model
{
    use HasFactory;

    public function getApiUrl(){
        return config('petstore.api_url');
    }

    /**
     * Sending given type of http request.
     * Parameters:
     * Request type,
     * URL,
     * data.
     * Returns http request object on success.
     */

    public function petRequest($type, $url, $data = []){
        $request = [];

        $url = "".$this->getApiUrl()."/".$url."";

        switch($type){
            case "get":{
                $data ? $request = Http::get($url, $data) : $request = Http::get($url);
            }break;
            case "post":{
                $data ? $request = Http::post($url, $data) : $request = Http::post($url);
            }break;
            case "put":{
                $data ? $request = Http::put($url, $data) : $request = Http::put($url);
            }break;
            case "delete":{
                $data ? $request = Http::delete($url, $data) : $request = Http::delete($url);
            }break;
            default:{
                return false;
            }
        }

        return $request;
    }

    /**
     * Creating a new pet.
     * Parameters: pet name as a form_pet_name request array variable.
     * Returns pet id on success.
     */

    public function createPet($data){
        $request = $this->petRequest("post", "pet", [
            "name" => $data["form_pet_name"]
        ]);

        if($request->ok()) return $request->json()["id"];
        else return false;
    }

    /**
     * Finding a existing pet.
     * Parameters: pet id.
     * Returns http request object on success.
     */

    public function findPet($pet_id){
        $request = $this->petRequest("get", "pet/".$pet_id."", [
            "petId" => $pet_id
        ]);

        return $request;
    }

    /**
     * Editing a existing pet.
     * Parameters:
     * pet id,
     * pet name.
     * Returns http request object on success.
     */

    public function editPet($pet_id, $new_name){
        $request = $this->petRequest("put", "pet", [
            "id" => $pet_id,
            "name" => $new_name
        ]);

        return $request;
    }

    /**
     * Deleting a existing pet.
     * Parameters:
     * pet id,
     * Returns true on success.
     */

    public function deletePet($pet_id){
        $request = $this->petRequest("delete", "pet/".$pet_id."");

        return $request;
    }
}
