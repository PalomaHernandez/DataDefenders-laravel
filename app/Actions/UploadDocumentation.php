<?php

namespace App\Actions;

use App\Models\Application;
use Illuminate\Support\Facades\Storage;

class UploadDocumentation {

	public static function execute(Application $request):void{
		$files = request()->file('files');
		foreach($files as $file){
			$request->documentationFiles()->create([
				'url' => Storage::disk('local')->putFileAs('documentation', $file, uniqid().'.pdf')
			]);
		}
	}

}