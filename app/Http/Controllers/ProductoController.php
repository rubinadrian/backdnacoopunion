<?php

namespace App\Http\Controllers;

use App\Producto;
use Illuminate\Http\Request;
use Response;
use Storage;
use Validator;

class ProductoController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return Producto::with('clase')->orderBy('nombre')->get();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {

		$validator = Validator::make($request->all(), [
			'nombre' => 'required',
			'clase_id' => 'required',
		]);

		if ($validator->fails()) {
			return response()->json($validator->errors());
		}

		if (isset($request->id) && $request->id > 0) {
			$p = Producto::findOrFail($request->id);
		} else {
			$p = new Producto();
		}

		$p->nombre = $request->nombre;
		$p->categoria = $request->categoria;
		$p->formadeuso = $request->formadeuso;
		$p->envasado = $request->envasado;
		$p->senasa = $request->senasa;
		$p->clase_id = $request->clase_id;
		$p->save();

		if ($request->hasFile('imagen')) {
			$old = $p->imagen;
			$p->imagen = Storage::disk('uploads')->put('', $request->file('imagen'));
			$this->deleteFile($old);
		}

		if ($request->hasFile('file_senasa')) {
			$old = $p->file_senasa;
			$p->file_senasa = Storage::disk('uploads')->put('', $request->file('file_senasa'));
			$this->deleteFile($old);
		}

		if ($request->hasFile('file_espe')) {
			$old = $p->file_espe;
			$p->file_espe = Storage::disk('uploads')->put('', $request->file('file_espe'));
			$this->deleteFile($old);
		}

		$p->save();

		return $p;
	}

	private function deleteFIle($file_name) {
		if (Storage::disk('uploads')->exists($file_name)) {
			Storage::disk('uploads')->delete($file_name);
		}
	}

	public function show($id) {
		return Producto::find($id);
	}

	public function edit(Producto $producto) {
		//
	}

	public function update(Request $request, Producto $producto) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Producto  $producto
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		if ($p = Producto::find($id)) {
			$this->deleteFIle($p->imagen);
			$this->deleteFIle($p->pdf);
			$p->delete();
		}
		return ['ok'];
	}

	public function showPDF($filename) {
		return Storage::disk('uploads')->download($filename);
		// $file = public_path()."/uploads/pdf/" . $fileNamePdf;
		// return Response::download($file,'coopunion.pdf');
	}

}
