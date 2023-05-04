<?php

namespace App\Actions;

use App\Models\Request;
use Illuminate\Support\Facades\Storage;

class UploadDocumentation {

	public static function execute(Request $request):void{
		$files = request()->file('files');
		foreach($files as $file){
			$request->documentationFiles()->create([
				'url' => Storage::disk('local')->putFileAs('documentation', $file, uniqid().'.pdf')
			]);
		}
	}

}