<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use App\Http\Resources\ContactCollection;

class ContactController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return Contact[]
     */
    public function index()
    {
        return new ContactCollection(Contact::with('businessType:id,name')->get());
    }

    /**
     *
     */
    public function create()
    {
        //
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @param $id
     * @return Contact
     */
    public function show($id)
    {
        return Contact::with('businessType', 'account')->findOrFail($id);
    }

    /**
     * @param $id
     */
    public function edit($id)
    {
        //
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        //
    }
}
