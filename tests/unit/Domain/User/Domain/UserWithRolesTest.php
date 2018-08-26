<?php

namespace Tests\unit\Domain\User\Domain;

use DDP\Domain\User\Domain\UserWithRoles;
use PHPUnit\Framework\TestCase;

class UserWithRolesTest extends TestCase
{
	public function testFromArrayName()
	{
		$User = new UserWithRoles();
		$User->setUseFirstLastName( false );

		$Arr[ 'id' ]             = 1;
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
		$Arr[ 'name' ]           = "{$Arr[ 'first_name' ]} {$Arr[ 'last_name' ]}";

		UserWithRoles::fromArray( $User, $Arr );

		$this->assertEquals(
			$User->getIdentifier(),
			$Arr[ 'id' ]
		);

		$this->assertEquals(
			$User->getName(),
			$Arr[ 'name' ]
		);


		$this->assertEquals(
			$User->getEmail(),
			$Arr[ 'email' ]
		);

		$this->assertEquals(
			$User->getPhoto(),
			$Arr[ 'photo' ]
		);

		$this->assertEquals(
			$User->getPhone(),
			$Arr[ 'phone' ]
		);

		$this->assertEquals(
			$User->getPassword(),
			$Arr[ 'password' ]
		);

		$this->assertEquals(
			$User->getRememberToken(),
			$Arr[ 'remember_token' ]
		);

		$this->assertEquals(
			$User->getCreatedAt(),
			$Arr[ 'created_at' ]
		);

		$this->assertEquals(
			$User->getUpdatedAt(),
			$Arr[ 'updated_at' ]
		);

		$this->assertEquals(
			$User->getDeletedAt(),
			$Arr[ 'deleted_at' ]
		);
	}

	public function testFromArrayFirstLast()
	{
		$User = new UserWithRoles();
		$User->setUseFirstLastName( true );

		$Arr[ 'id' ]             = 1;
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
		$Arr[ 'name' ]           = "{$Arr[ 'first_name' ]} {$Arr[ 'last_name' ]}";

		UserWithRoles::fromArray( $User, $Arr );

		$this->assertEquals(
			$User->getIdentifier(),
			$Arr[ 'id' ]
		);

		$this->assertEquals(
			$User->getFirstName(),
			$Arr[ 'first_name' ]
		);

		$this->assertEquals(
			$User->getLastName(),
			$Arr[ 'last_name' ]
		);

		$this->assertEquals(
			$User->getEmail(),
			$Arr[ 'email' ]
		);

		$this->assertEquals(
			$User->getPhoto(),
			$Arr[ 'photo' ]
		);

		$this->assertEquals(
			$User->getPhone(),
			$Arr[ 'phone' ]
		);

		$this->assertEquals(
			$User->getPassword(),
			$Arr[ 'password' ]
		);

		$this->assertEquals(
			$User->getRememberToken(),
			$Arr[ 'remember_token' ]
		);

		$this->assertEquals(
			$User->getCreatedAt(),
			$Arr[ 'created_at' ]
		);

		$this->assertEquals(
			$User->getUpdatedAt(),
			$Arr[ 'updated_at' ]
		);

		$this->assertEquals(
			$User->getDeletedAt(),
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
		$User->setPhone(11);
		$User->setPhoto(12);
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
