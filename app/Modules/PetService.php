<?php

namespace App\Modules;

use Illuminate\Support\Facades\Http;

class PetService{
    /**
     * Creating a new pet.
     * Parameters: pet name as a form_pet_name request array variable.
     * Returns pet id on success.
     */

     public function createPet($data){
        $request = Http::petsApi()->post("/pet", [
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
        $request = Http::petsApi()->get("pet/".$pet_id."", [
            "petId" => $pet_id,
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
        $request = Http::petsApi()->put("pet", [
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
        $request = Http::petsApi()->delete("pet/".$pet_id."");

        return $request;
    }
}
