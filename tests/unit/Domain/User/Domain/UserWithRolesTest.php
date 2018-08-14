<?php

namespace Tests\unit\Domain\User\Domain;

use DDP\Domain\User\Domain\UserWithRoles;
use PHPUnit\Framework\TestCase;

class UserWithRolesTest extends TestCase
{
	public function testFromArray()
	{
		$Entity = new UserWithRoles();

		$Arr[ 'id' ]             = 1;
		$Arr[ 'name' ]           = 2;
		$Arr[ 'first_name' ]     = 3;
		$Arr[ 'last_name' ]      = 4;
		$Arr[ 'email' ]          = 5;
		$Arr[ 'password' ]       = 6;
		$Arr[ 'remember_token' ] = 7;
		$Arr[ 'created_at' ]     = 8;
		$Arr[ 'updated_at' ]     = 9;
		$Arr[ 'deleted_at' ]     = 10;
		$Arr[ 'photo' ]          = 11;
		$Arr[ 'phone' ]          = 12;

		UserWithRoles::fromArray( $Entity, $Arr );

		$this->assertEquals(
			$Entity->getIdentifier(),
			$Arr[ 'id' ]
		);

		$this->assertEquals(
			$Entity->getName(),
			$Arr[ 'name' ]
		);

		$this->assertEquals(
			$Entity->getFirstName(),
			$Arr[ 'first_name' ]
		);

		$this->assertEquals(
			$Entity->getLastName(),
			$Arr[ 'last_name' ]
		);

		$this->assertEquals(
			$Entity->getEmail(),
			$Arr[ 'email' ]
		);

		$this->assertEquals(
			$Entity->getPhoto(),
			$Arr[ 'photo' ]
		);

		$this->assertEquals(
			$Entity->getPhone(),
			$Arr[ 'phone' ]
		);

		$this->assertEquals(
			$Entity->getPassword(),
			$Arr[ 'password' ]
		);

		$this->assertEquals(
			$Entity->getRememberToken(),
			$Arr[ 'remember_token' ]
		);

		$this->assertEquals(
			$Entity->getCreatedAt(),
			$Arr[ 'created_at' ]
		);

		$this->assertEquals(
			$Entity->getUpdatedAt(),
			$Arr[ 'updated_at' ]
		);

		$this->assertEquals(
			$Entity->getDeletedAt(),
			$Arr[ 'deleted_at' ]
		);
	}

	public function testToStdClass()
	{
		$User = new UserWithRoles();

		$User->setIdentifier( 1 );
		$User->setName( 2 );
		$User->setFirstName( 3 );
		$User->setLastName( 4 );
		$User->setEmail( 5 );
		$User->setPassword( 6 );
		$User->setRememberToken( 7 );
		$User->setCreatedAt( 8 );
		$User->setUpdatedAt( 9 );
		$User->setDeletedAt( 10 );

		$Obj = $User->toStdClass();

		$this->assertEquals(
			$User->getIdentifier(),
			$Obj->id
		);

		$this->assertEquals(
			$User->getName(),
			$Obj->name
		);

		$this->assertEquals(
			$User->getFirstName(),
			$Obj->first_name
		);

		$this->assertEquals(
			$User->getLastName(),
			$Obj->last_name
		);

		$this->assertEquals(
			$User->getEmail(),
			$Obj->email
		);

		$this->assertEquals(
			$User->getPassword(),
			$Obj->password
		);

		$this->assertEquals(
			$User->getPhone(),
			$Obj->phone
		);

		$this->assertEquals(
			$User->getPhoto(),
			$Obj->photo
		);

		$this->assertEquals(
			$User->getRememberToken(),
			$Obj->remember_token
		);
	}
}
