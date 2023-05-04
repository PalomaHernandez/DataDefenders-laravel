<?php
return [
	'Administrator' => [
		'*'
	],
	'Executive' => [
		'list.requests',
		'require.request.documentation',
		'accept.requests',
		'reject.requests',
	],
	'Offer Manager' => [
		'list.offers',
		'create.offers',
		'edit.offers',
		'delete.offers',
		'list.departments',
		'create.departments',
		'list.majors',
		'create.majors',
		'edit.majors',
		'delete.majors',
	],
	'Applicant' => [
		'apply.to.offers',
		'list.own.requests',
		'review.own.requests',
		'delete.own.requests',
	],
];