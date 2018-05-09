<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Person;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Get People data.
     *
     * @param Person $person
     * @return mixed
     */
    public function index(Person $person)
    {
        return $person->with('contacts')->paginate(10);
    }

    /**
     *  Creates a Person and Contacts if any.
     *
     * @param Request $request
     * @param Person $person
     * @param Contact $contact
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request, Person $person, Contact $contact)
    {
        $input = $request->all();

        $validationRules = [
            'name' => 'required|min:3',
        ];

        $validator = \Validator::make($input, $validationRules);

        if ($validator->fails()) {
            return new \Illuminate\Http\JsonResponse(
                [
                    'errors' => $validator->errors()
                ], \Illuminate\Http\Response::HTTP_BAD_REQUEST
            );
        }

        $person_id = $person->create($input);

        if ($request->has('contacts')) {

            foreach ($request->contacts['contact'] as $key => $value) {

                if (!isset($request->contacts['value'][$key])) continue;

                $contactData = [
                    'person_id' => $person_id,
                    'contact' => $value,
                    'value' => $request->contacts['value'][$key],
                    'created_at' => new \DateTime(),
                ];

                $contact->create($contactData);
            }
        }

        return $person->find($person_id);
    }

    /**
     * Get the data of a single Person and Contacts if any.
     *
     * @param $id
     * @param Person $person
     * @return mixed
     */
    public function show($id, Person $person)
    {
        return $person->find($id);
    }

    /**
     * Update a Person and Contacts if any.
     *
     * @param Request $request
     * @param Person $person
     * @param Contact $contact
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Person $person, Contact $contact, $id)
    {
        $input = $request->all();

//        print_r($input);
//        die();

        $validationRules = [
            'name' => 'required|min:3',
        ];

        $validator = \Validator::make($input, $validationRules);

        if ($validator->fails()) {
            return new \Illuminate\Http\JsonResponse(
                [
                    'errors' => $validator->errors()
                ], \Illuminate\Http\Response::HTTP_BAD_REQUEST
            );
        }

        $person = $person->find($id);

        $person->fill($input);

        $person->save();

        if ($request->has('contacts')) {

            foreach ($request->contacts['contact'] as $key => $value) {

                if (!isset($request->contacts['value'][$key])) continue;

                $contactData = [
                    'person_id' => $id,
                    'contact' => $value,
                    'value' => $request->contacts['value'][$key],
                ];

                if (isset($request->contacts['id'][$key])) {
                    $contactData['created_at'] = new \DateTime();
                    $contact->where('id', $request->contacts['id'][$key])->update($contactData);
                } else {
                    $contactData['updated_at'] = new \DateTime();
                    $contact->create($contactData);
                }
            }
        }

        return $person->find($id);
    }

    /**
     * Remove a Person and Contacts if any.
     *
     * @param Person $person
     * @param $id
     * @return array
     */
    public function destroy(Person $person, $id)
    {
        $person = $person->find($id);

        $person->destroy($id);

        return [
            'message' => 'Successfully deleted', 'person_id' => $id
        ];
    }
}
