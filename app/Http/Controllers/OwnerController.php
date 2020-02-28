<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Owner;


class OwnerController extends Controller
{
    public function index() {
        $owner = Owner::all();
        $view = view('owner.index', compact('owner'));

        return $view;
    }
}
