<?php

namespace App\Patterns\State\Request;

enum RequestStatus:string {

	case Pending = 'pending';

	case Documentation = 'documentation';

	case Approved = 'approved';

	case Rejected = 'rejected';

	public function canUpdate():bool{
		return match ($this) {
			self::Pending, self::Documentation => true,
			self::Approved, self::Rejected => false,
		};
	}

}
