<?php

namespace App\Http\Controllers;

use App\Models\HallNotice;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $notices = HallNotice::where('status', 'active')->orderBy('created_at', 'desc')->get();
        return view('homepage', ['notices' => $notices]);
    }

    public function showPublicNotice($id)
    {
        $notice = HallNotice::where('notice_id', $id)->where('status', 'active')->firstOrFail();
        return response()->json($notice);
    }
}