<?php

namespace App\Actions;

use App\Models\Application;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class UploadDocumentation {

	public static function execute(Application $request):Collection{
		$files = request()->file('files');
		$documentationFiles = collect();
		foreach($files as $file){
			$documentationFiles->add($request->documentationFiles()->create([
				'path' => Storage::disk('local')->putFileAs('documentation', $file, uuid_create().'.pdf')
			]));
		}
		return $documentationFiles;
	}

}