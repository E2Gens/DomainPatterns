<?php

namespace Tests\unit\Domain\User\Domain;

use DDP\Domain\User\Domain\UserWithRoles;
use PHPUnit\Framework\TestCase;

class UserWithRolesTest extends TestCase
{
	public $Data;
	
	protected function setUp()
	{
		parent::setUp();

		$this->Data[ 'id' ]             = 1;
		$this->Data[ 'first_name' ]     = "First";
		$this->Data[ 'last_name' ]      = "Last";
		$this->Data[ 'email' ]          = 'test@example.org';
		$this->Data[ 'password' ]       = '12345';
		$this->Data[ 'remember_token' ] = '12345';
		$this->Data[ 'created_at' ]     = '2018-08-01 12:13:14';
		$this->Data[ 'updated_at' ]     = '2018-08-02 12:13:14';
		$this->Data[ 'deleted_at' ]     = '2018-08-03 15:16:17';
		$this->Data[ 'photo' ]          = 'face.jpg';
		$this->Data[ 'phone' ]          = '941-555-5555';
		$this->Data[ 'name' ]           = "{$this->Data['first_name']} {$this->Data['last_name']}";
	}

	public function testFromArrayName()
	{
		$User = new UserWithRoles();
		$User->setUseFirstLastName( false );

		UserWithRoles::fromArray( $User, $this->Data );

		$this->assertEquals(
			$User->getIdentifier(),
			$this->Data[ 'id' ]
		);

		$this->assertEquals(
			$User->getName(),
			$this->Data[ 'name' ]
		);


		$this->assertEquals(
			$User->getEmail(),
			$this->Data[ 'email' ]
		);

		$this->assertEquals(
			$User->getPhoto(),
			$this->Data[ 'photo' ]
		);

		$this->assertEquals(
			$User->getPhone(),
			$this->Data[ 'phone' ]
		);

		$this->assertEquals(
			$User->getPassword(),
			$this->Data[ 'password' ]
		);

		$this->assertEquals(
			$User->getRememberToken(),
			$this->Data[ 'remember_token' ]
		);

		$this->assertEquals(
			$User->getCreatedAt(),
			$this->Data[ 'created_at' ]
		);

		$this->assertEquals(
			$User->getUpdatedAt(),
			$this->Data[ 'updated_at' ]
		);

		$this->assertEquals(
			$User->getDeletedAt(),
			$this->Data[ 'deleted_at' ]
		);
	}

	public function testFromArrayFirstLast()
	{
		$User = new UserWithRoles();
		$User->setUseFirstLastName( true );

		UserWithRoles::fromArray( $User, $this->Data );

		$this->assertEquals(
			$User->getIdentifier(),
			$this->Data[ 'id' ]
		);

		$this->assertEquals(
			$User->getFirstName(),
			$this->Data[ 'first_name' ]
		);

		$this->assertEquals(
			$User->getLastName(),
			$this->Data[ 'last_name' ]
		);

		$this->assertEquals(
			$User->getEmail(),
			$this->Data[ 'email' ]
		);

		$this->assertEquals(
			$User->getPhoto(),
			$this->Data[ 'photo' ]
		);

		$this->assertEquals(
			$User->getPhone(),
			$this->Data[ 'phone' ]
		);

		$this->assertEquals(
			$User->getPassword(),
			$this->Data[ 'password' ]
		);

		$this->assertEquals(
			$User->getRememberToken(),
			$this->Data[ 'remember_token' ]
		);

		$this->assertEquals(
			$User->getCreatedAt(),
			$this->Data[ 'created_at' ]
		);

		$this->assertEquals(
			$User->getUpdatedAt(),
			$this->Data[ 'updated_at' ]
		);

		$this->assertEquals(
			$User->getDeletedAt(),
			$this->Data[ 'deleted_at' ]
		);
	}

	public function testArrayMapName()
	{
		$User = new UserWithRoles();
		$User->setUseFirstLastName( false );

		$User->arrayMap( $this->Data );

		$this->assertEquals(
			$User->getIdentifier(),
			$this->Data[ 'id' ]
		);

		$this->assertEquals(
			$User->getName(),
			$this->Data[ 'name' ]
		);


		$this->assertEquals(
			$User->getEmail(),
			$this->Data[ 'email' ]
		);

		$this->assertEquals(
			$User->getPhoto(),
			$this->Data[ 'photo' ]
		);

		$this->assertEquals(
			$User->getPhone(),
			$this->Data[ 'phone' ]
		);

		$this->assertEquals(
			$User->getPassword(),
			$this->Data[ 'password' ]
		);

		$this->assertEquals(
			$User->getRememberToken(),
			$this->Data[ 'remember_token' ]
		);

		$this->assertEquals(
			$User->getCreatedAt(),
			$this->Data[ 'created_at' ]
		);

		$this->assertEquals(
			$User->getUpdatedAt(),
			$this->Data[ 'updated_at' ]
		);

		$this->assertEquals(
			$User->getDeletedAt(),
			$this->Data[ 'deleted_at' ]
		);
	}

	public function testArrayMapFirstLast()
	{
		$User = new UserWithRoles();
		$User->setUseFirstLastName( true );

		$User->arrayMap( $this->Data );

		$this->assertEquals(
			$User->getIdentifier(),
			$this->Data[ 'id' ]
		);

		$this->assertEquals(
			$User->getFirstName(),
			$this->Data[ 'first_name' ]
		);

		$this->assertEquals(
			$User->getLastName(),
			$this->Data[ 'last_name' ]
		);

		$this->assertEquals(
			$User->getEmail(),
			$this->Data[ 'email' ]
		);

		$this->assertEquals(
			$User->getPhoto(),
			$this->Data[ 'photo' ]
		);

		$this->assertEquals(
			$User->getPhone(),
			$this->Data[ 'phone' ]
		);

		$this->assertEquals(
			$User->getPassword(),
			$this->Data[ 'password' ]
		);

		$this->assertEquals(
			$User->getRememberToken(),
			$this->Data[ 'remember_token' ]
		);

		$this->assertEquals(
			$User->getCreatedAt(),
			$this->Data[ 'created_at' ]
		);

		$this->assertEquals(
			$User->getUpdatedAt(),
			$this->Data[ 'updated_at' ]
		);

		$this->assertEquals(
			$User->getDeletedAt(),
			$this->Data[ 'deleted_at' ]
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
