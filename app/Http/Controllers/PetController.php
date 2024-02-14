<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class PetController extends Controller
{
    public function index(Request $request){
        // https://petstore.swagger.io/v2/pet

        return view("pet.index");
    }

    public function createPet(Request $request){
        $pet_data = $request->only("form_pet_name");

        $rules = [
            "form_pet_name" => "required",
        ];

        $field_names = [
            "form_pet_name" => "Nazwa zwierzaka",
        ];

        $messages = [
            "form_pet_name.required" => ":attribute jest wymagana.",
        ];

        $validator = Validator::make($pet_data, $rules, $messages, $field_names);

        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }

        $pet = new Pet;

        $status = $pet->createPet($pet_data);

        if($status){
            return back()->with("success", "Udało się dodać nowego zwierzaka. ID utworzonego wpisu: ".$status.".");
        }else return back()->withErrors("Coś poszło nie tak! Spróbuj ponownie.");
    }

    public function findPet(Request $request){
        $pet_data = $request->only("form_find_pet_id");

        $rules = [
            "form_find_pet_id" => "required|numeric",
        ];

        $field_names = [
            "form_find_pet_id" => "ID zwierzaka",
        ];

        $messages = [
            "form_find_pet_id.required" => ":attribute jest wymagane.",
            "form_find_pet_id.numeric" => ':attribute musi być liczbą.'
        ];

        $validator = Validator::make($pet_data, $rules, $messages, $field_names);

        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }

        $pet = new Pet;

        $status = $pet->findPet($pet_data["form_find_pet_id"]);

        if($status->ok()){
            return back()->with("success", "Udało się odnaleźć szukanego zwierzaka. Nazwa: ".$status->json()['name'].".");
        }else{
            if($status->status() == 400) return back()->withErrors("Podano nieprawidłowe ID zwierzaka.");
            else if($status->status() == 404) return back()->withErrors("Nie odnaleziono zwierzaka o takim ID.");
            else return back()->withErrors("Coś poszło nie tak! Spróbuj ponownie.");
        }
    }

    public function editPet(Request $request){
        $pet_data = $request->except("_token");

        $rules = [
            "form_edit_pet_pet_id" => "required|numeric",
            "form_edit_pet_pet_name" => "required"
        ];

        $field_names = [
            "form_edit_pet_pet_id" => "ID zwierzaka",
            "form_edit_pet_pet_name" => "Nowa nazwa zwierzaka"
        ];

        $messages = [
            "form_edit_pet_pet_id.required" => ":attribute jest wymagane.",
            "form_edit_pet_pet_id.numeric" => ":attribute musi być liczbą.",
            "form_edit_pet_pet_name.required." => ":attribute jest wymagana."
        ];

        $validator = Validator::make($pet_data, $rules, $messages, $field_names);

        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }

        $pet = new Pet;

        $status = $pet->editPet($pet_data["form_edit_pet_pet_id"], $pet_data["form_edit_pet_pet_name"]);

        if($status->ok()){
            return back()->with("success", "Udało się edytować wybranego zwierzaka.");
        }else{
            if($status->status() == 400) return back()->withErrors("Podano nieprawidłowe ID zwierzaka.");
            else if($status->status() == 404) return back()->withErrors("Nie odnaleziono zwierzaka o takim ID.");
            else return back()->withErrors("Coś poszło nie tak! Spróbuj ponownie.");
        }
    }

    public function deletePet(Request $request){
        $pet_data = $request->except("_token");

        $rules = [
            "form_delete_pet_pet_id" => "required|numeric",
        ];

        $field_names = [
            "form_delete_pet_pet_id" => "ID zwierzaka",
        ];

        $messages = [
            "form_delete_pet_pet_id.required" => ":attribute jest wymagane.",
            "form_delete_pet_pet_id.numeric" => ":attribute musi być liczbą.",
        ];

        $validator = Validator::make($pet_data, $rules, $messages, $field_names);

        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }

        $pet = new Pet;

        $status = $pet->deletePet($pet_data["form_delete_pet_pet_id"]);

        if($status->ok()){
            return back()->with("success", "Pomyślnie usunięto wybranego zwierzaka.");
        }else{
            if($status->status() == 400) return back()->withErrors("Podano nieprawidłowe ID zwierzaka.");
            else if($status->status() == 404) return back()->withErrors("Nie odnaleziono zwierzaka o takim ID.");
            else return back()->withErrors("Coś poszło nie tak! Spróbuj ponownie.");
        }
    }
}
