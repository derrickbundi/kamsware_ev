<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Location,Client,Product};
use Carbon\Carbon;

class pagescontroller extends Controller
{
    public function index() {
        $locations = Location::orderBy('id', 'desc')->limit(10)->get();
        $clients = Client::orderBy('id', 'desc')->withCount('products')->get();
        return view('index', compact('locations', 'clients'));
    }
    public function clients() {
        $locations = Location::orderBy('id', 'desc')->get();
        $clients = Client::orderBy('id', 'desc')->get();
        return view('pages.add_client', compact('locations','clients'));
    }
    public function add_client(Request $request) {
        $this->validate($request, [
            'fname' => 'required|min:5|max:25',
            'idNumber' => 'required|unique:clients',
            'phoneNumber' => 'required|unique:clients',
            'dob' => [
              'required',
              function ($attribute, $value, $fail) {
                 $now = Carbon::now();
                 $userDob = Carbon::parse($value);
                 if ($userDob->diffInYears($now) <= 18) {
                     $fail('You are less than 18 years old');
                 }
              },
           ]
        ]);
        Client::create([
            'firstName' => $request->fname,
            'lastName' => $request->lname,
            'dateOfBirth' => $request->dob,
            'idNumber' => $request->idNumber,
            'phoneNumber' => $request->phoneNumber,
            'location' => $request->location
        ]);
        return redirect()->back()->with('status', 'Client added successfully.');
    }
    public function products() {
        $users = Client::get(['id', 'firstName', 'lastName']);
        $products = Product::with('client')->get();
        return view('pages.add_product', compact('users','products'));
    }
    public function add_product(Request $request) {
        $this->validate($request, [
            'product_name' => 'required|min:5|max:50',
            'description' => 'required|min:5|max:50',
            'quantity' => 'required|gt:0|lt:1000'
        ]);
        Product::create([
            'name' => $request->product_name,
            'client_id' => $request->client,
            'description' => strip_tags($request->description),
            'quantity' => $request->quantity
        ]);
        return redirect()->back()->with('status', 'Product added successfully.');
    }
    public function edit_product(Request $request, $id) {
        $this->validate($request, [
            'product_name' => 'required|min:5|max:50',
            'description' => 'required|min:5|max:50',
            'quantity' => 'required|gt:0|lt:1000'
        ]);
        $product = Product::find(base64_decode($id));
        $product->name = $request->product_name;
        $product->description = strip_tags($request->description);
        $product->client_id = $request->client;
        $product->save();
        return redirect()->back()->with('status', 'Product edited successfully.');
    }
    public function delete_product($id) {
        $product = Product::find($id)->delete();
        return redirect()->back()->with('status', 'Product deleted successfully.');
    }
    public function add_center(Request $request) {
        $this->validate($request, [
            'location_name' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);
        Location::create([
            'location_name' => $request->location_name,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);
        return redirect()->back()->with('status', 'Location added successfully.');
    }
}
