<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Mail;
use Validator;

class MailController extends Controller {
	public function sendMailContact(Request $request) {

		$validator = Validator::make($request->all(), [
			'nombre' => 'required|max:50',
			'email' => 'required',
			'mensaje' => 'required',
		]);

		if ($validator->fails()) {
			return response()->json($validator->errors());
		}

		Mail::to('oramello@coopunion.com.ar')->send(new ContactMail($request));
	}
}
