<?php

namespace App\Patterns\State\Request;

enum ApplicationStatus:string {

	case Payment = 'payment';

	case Pending = 'pending';

	case Documentation = 'documentation';

	case Accepted = 'accepted';

	case Rejected = 'rejected';

	public function canUpdate():bool{
		return match ($this) {
			self::Payment, self::Pending, self::Documentation => true,
			self::Accepted, self::Rejected => false,
		};
	}

}
