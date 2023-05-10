<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Department;
use App\Models\DocumentationFile;
use App\Models\JobOffer;
use App\Models\Major;
use App\Models\Application;
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
			'first_name' => config('seeder.first_name'),
			'middle_name' => config('seeder.middle_name'),
			'last_name' => config('seeder.last_name'),
			'email'      => config('seeder.email'),
			'password'   => Hash::make(config('seeder.password')),
		]);
		$admin->assign('administrator');
		Department::factory(5)->create();
		JobOffer::factory(5)->create();
		Major::factory(15)->create();
		$scholarshipOffers = ScholarshipOffer::factory(5)->create();
		foreach($scholarshipOffers as $offer){
			$offer->majors()->sync(Major::distinct()->limit(rand(1, 3))->pluck('id'));
		}
		$applications = Application::factory(35)->create();
		foreach($applications as $application){
			$fileCount = rand(1, 5);
			for($i = 0; $i <= $fileCount; $i++){
				DocumentationFile::factory()->create([
					'application_id' => $application->id,
				]);
			}
			for($i = 0; $i <= rand(0, $fileCount); $i++){
				Comment::factory()->create([
					'application_id' => $application->id,
					'user_id'    => User::inRandomOrder()->first('id')->id
				]);
			}
			if($application->offer_type == ScholarshipOffer::class){
				$application->update([
					'major_id' => $application->offer->majors->first()->id
				]);
			}
		}
	}

}
