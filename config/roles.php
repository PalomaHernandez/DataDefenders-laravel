<?php
return [
	'Administrator' => [
		'*'
	],
	'Executive' => [
		'list.applications',
		'require.application.documentation',
		'accept.applications',
		'reject.applications',
	],
	'Offer Manager' => [
		'list.offers',
		'create.offers',
		'edit.offers',
		'delete.offers',
		'list.departments',
		'create.departments',
		'edit.departments',
		'delete.departments',
		'list.majors',
		'create.majors',
		'edit.majors',
		'delete.majors',
	],
	'Applicant' => [
		'apply.to.offers',
		'list.own.applications',
		'review.own.applications',
		'delete.own.applications',
	],
];