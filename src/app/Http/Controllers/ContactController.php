<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class PersonController extends Controller
{

    /**
     * Remove a Contacts of a Person.
     *
     * @param Person $person
     * @param $id
     * @return array
     */
    public function destroy(Contact $contact, $id)
    {
        $contact = $contact->find($id);

        $contact->destroy($id);

        return [
            'message' => 'Successfully deleted', 'person_id' => $id
        ];
    }
}
