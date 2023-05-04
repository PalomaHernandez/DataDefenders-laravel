<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Department;
use App\Models\DocumentationFile;
use App\Models\JobOffer;
use App\Models\Major;
use App\Models\Request;
use App\Models\ScholarshipOffer;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Silber\Bouncer\BouncerFacade;

class DatabaseSeeder extends Seeder {

	/**
	 * Seed the application's database.
	 */
	public function run():void{
		foreach(config('roles') as $roleName => $abilities){
			$role = BouncerFacade::role()->create([
				'name' => Str::slug($roleName),
				'title' => $roleName
			]);
			BouncerFacade::allow($role)->to($abilities);
		}
		User::factory(45)->create();
		$admin = User::factory()->create([
			'first_name' => config('seeder.name'),
			'email'      => config('seeder.email'),
			'password'   => Hash::make(config('seeder.password')),
		]);
		$admin->assign('administrator');
		Department::factory(5)->create();
		JobOffer::factory(5)->create();
		Major::factory(15)->create();
		ScholarshipOffer::factory(5)->create();
		$requests = Request::factory(35)->create();
		foreach($requests as $request){
			$fileCount = rand(1, 5);
			for($i = 0; $i <= $fileCount; $i++){
				DocumentationFile::factory()->create([
					'request_id' => $request->id,
				]);
			}
			for($i = 0; $i <= rand(0, $fileCount); $i++){
				Comment::factory()->create([
					'request_id' => $request->id,
					'user_id'    => User::inRandomOrder()->first('id')->id
				]);
			}
			$majorCount = rand(1, 3);
			if($request->offer_type == ScholarshipOffer::class){
				for($i = 0; $i < $majorCount; $i++){
					$request->offer->majors()->attach(Major::inRandomOrder()->first('id')->id);
				}
			}
		}
	}

}
