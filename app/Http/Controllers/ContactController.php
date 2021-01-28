<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Resources\ContactCollection;
use App\Http\Resources\Contact as ContactResource;

class ContactController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->ruleNames = 'validation.contacts';
    }

    /**
     * Get all Contacts
     *
     * @param Request $request
     * @return ContactCollection
     */
    public function index()
    {
        return new ContactCollection(Contact::all());
    }

    /**
     * Create new Contact
     *
     * @param Request $request
     * @return ContactResource
     */
    public function store(Request $request)
    {
        $validator = $this->validation($request);
        if ($validator !== true) return response()->json($validator, 400);
        try {
            $contact = new Contact;
            if ($request->has('name')) $contact->name = $request->name;
            if ($request->has('email')) $contact->email = $request->email;
            if ($request->has('type')) $contact->type = $request->type;
            if ($request->has('bio')) $contact->bio = $request->bio;
            if ($request->has('discount')) $contact->discount = $request->discount;
            if ($request->has('phone_number')) $contact->phone_number = $request->phone_number;
            if ($request->has('mobile_phone')) $contact->mobile_phone = $request->mobile_phone;
            if ($request->has('skype')) $contact->skype = $request->skype;
            if ($request->has('fax')) $contact->fax = $request->fax;
            if ($request->has('website')) $contact->website = $request->website;
            $contact->save();
            if ($request->has('account')) $contact->account()->associate(Account::findOrFail($request->account));
            $contact->push();
        } catch (\Exception $ex) {
            return response()->json(['error' => 'There was an error in your request'], 400);
        }
        return new ContactResource($contact->refresh());
    }

    /**
     * Get one Contact
     *
     * @param $id
     * @return Contact
     */
    public function show($id)
    {
        return new ContactResource(Contact::with('account')->findOrFail($id));
    }

    /**
     * Update one Contact
     *
     * @param Request $request
     * @param $id
     * @return ContactResource
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validation($request);
        if ($validator !== true) return response()->json($validator, 400);
        $contact = Contact::findOrFail($id);
        try {
            if ($request->has('name')) $contact->name = $request->name;
            if ($request->has('email')) $contact->email = $request->email;
            if ($request->has('type')) $contact->type = $request->type;
            if ($request->has('bio')) $contact->bio = $request->bio;
            if ($request->has('discount')) $contact->discount = $request->discount;
            if ($request->has('phone_number')) $contact->phone_number = $request->phone_number;
            if ($request->has('mobile_phone')) $contact->mobile_phone = $request->mobile_phone;
            if ($request->has('skype')) $contact->skype = $request->skype;
            if ($request->has('fax')) $contact->fax = $request->fax;
            if ($request->has('website')) $contact->website = $request->website;
            if ($request->has('account')) $contact->account()->associate(Account::findOrFail($request->account));
            $contact->save();
        } catch (\Exception $ex) {
            return response()->json(['error' => 'There was an error in your request'], 400);
        }
        return new ContactResource($contact->refresh());
    }

    /**
     * Delete one Contact
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $res = Contact::findOrFail($id);
        if (!$res->delete()) return response()->json(['error' => 'Couldn\'t delete contact']);
        return response()->json(true, 200);
    }
}
