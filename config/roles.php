<?php
return [
	'Administrator' => [
		'*'
	],
	'Executive' => [
		'require.request.documentation',
		'accept.requests',
		'reject.requests',
	],
	'Offer Manager' => [
		'create.offers',
		'update.offers',
		'delete.offers',
		'create.departments',
		'create.majors',
		'update.majors',
		'delete.majors',
	],
	'Applicant' => [
		'apply.to.offers',
		'review.requests',
		'delete.requests',
	],
];