<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
        public function getContacts($id)
        {
            $contacts = Contact::where("user_id" , $id)->get();  
            return response()->json($contacts);
        }

    public function storeContact(Request $request ,$id)
    {

        $contactNumber = $request->input('phone_number');
        $existingContact = Contact::where('phone_number', $contactNumber)->first();
    
        if ($existingContact) {
            return response()->json(['message' => 'Contact with the same number already exists'], 409);
        }
    
        if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image');
            $picname = $uploadedFile->getClientOriginalName();
            $uploadedFile->move(public_path('images'), $picname);
            $contact = new Contact();
            $contact->user_id = $request->user_id;
            $contact->name = $request->name;
            $contact->phone_number = $request->phone_number;
            $contact->latitude = $request->latitude;
            $contact->longitude = $request->longitude;
            $contact->pic_url = $picname;
            $contact->location_name = $request->location_name;

            $contact->save();
    
            return response()->json(['product' => $contact]);
        }
        $contact = new Contact();
        $contact->user_id = $request->user_id;
        $contact->name = $request->name;
        $contact->phone_number = $request->phone_number;
        $contact->latitude = $request->latitude;
        $contact->longitude = $request->longitude;
        $contact->pic_url = "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png";
        $contact->location_name = $request->location_name;
        $contact->save();
    
        return response()->json([
            'message' => "Contact successfully created",
            'contact' =>$contact
        ]);
    }


    public function updateContact(Request $request, $id)
    {
       $request->validate([
            'name' => 'required|string',
            'phone_number' => 'required|numeric',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $contact = Contact::where("user_id" , $id)->first();
        $contact->name = $request->name;
        $contact->phone_number = $request->phone_number;
        $contact->latitude = $request->latitude;
        $contact->longitude = $request->longitude;
        $contact->location_name = $request->location_name;

        $contact->save();
        return response()->json($contact, 200);
    }

    public function destroyContact($id)
    {
        $contact = Contact::where('id' , $id)->first();
  
        if (!$contact) {
            return response()->json(['message' => 'Contact not found'], 404);
        }else{
            $contact->delete();
            return response()->json(['message' => 'Contact deleted'], 404);
        }
        

    }
}
