# Versions

## 0.0.64

## 0.0.63 2018-09-01
* Added datetime validation to timestamps.

## 0.0.62 2018-09-01
* Added auto mapping of timestamps in Entitybase.

## 0.0.61 2108-09-01
* Implemented automapper functionality.

## 0.0.60
* Fix to update user id if roles added before save.'

## 0.0.59
* Starting to build out accounting subdomain structure.
* Fixes to content domain repositories.

## 0.0.58 2018-08-28
* Removed backslashes from scalar type in IHashService interface and LaravelIHashService class.

## 0.0.57 2018-08-25
* Added the ability to toggle between name and first/last in userwithroles.

## 0.0.55 2018-08-25
* Fixed another userwithroles mapper issue relating to roles.

## 0.0.54 2018-08-24
* Fixed an issue with UserWithRoles array mapper.

## 0.0.53 2018-08-24
* Added IHashService and LaravelIHashService implementation.

## 0.0.52 2018-08-23
* Added better detail to validation failures.
* Updated uservalidatortest.

## 0.0.51 2018-08-23
* Fix to validation registry.

## 0.0.50 2018-08-21
* Updated userwithroles mapper.

## 0.0.49
* Fixed an issue in UserRepository save.

## 0.0.48 2018-08-21
* Fixed an issue with UserWithRolesRepository.

## 0.0.47 2018-08-20
* getAllByRoleName() of UserWithRoles entity is now private method.
* TimestampsTrait created, entities refactored to use the trait.

## 0.0.46 2018-08-20
* Removed entity typing from user api.

## 0.0.45 2018-08-20
* Final updates to dblogdestination for laravel.

## 0.0.44 2018-08-20
* Fix to dblogdestination.

## 0.0.43 2018-08-20
* Added a test for Application::init()

## 0.0.42 2018-08-20
* Adds first pass at database logging using neuron.

## 0.0.41 2018-08-15
* User and content entities refactoring, writing more unit tests.

## 0.0.40 2018-08-13
* fromArray() mapper updated.

## 0.0.39 2018-08-10
* Legacy code has been removed from UserRepository save() method.

## 0.0.38 2018-08-05
* Merges pages and content blocks into the content domain.
* getByEmail() method added in user repository.

## 0.0.37 2018-08-04
* New *doesEmailExist()* method added.
* toStdClass() method refactored to provide ability to update specific columns in users table.

## 0.0.36 2018-08-01
* Modified queries in page and block repo to use firstOrFail().

## 0.0.35 2018-07-27
* ModifiedBy added to Page.
* Query fix in PageRepository.
* Method name refactoring.

## 0.0.34 2018-07-26
* Page entity and PageRepository implemented.

## 0.0.33 2018-07-25
* Issues fixed related to ContentBlock.

## 0.0.32 2018-07-24
* Domain and Infrastructure created for Content Block.
* Initial implementation of Entity and Repository for the Page. 

## 0.0.31 2018-07-20
* Added logic to order the States and Countries by Name

## 0.0.30 2018-07-19
* Issue related to avatar_url is fixed.

## 0.0.29
* fromRequest() method deprecated.
* Middle initial field added to User entity.

## 0.0.28
* Getting state in toStdClass method.

## 0.0.27
* State field added in UserWithRole entity.
* Issue fixed in addOrRemvoeRole method.

## 0.0.26
* Refactoring.

## 0.0.25 2018-07-10
* Added getAllByRoleName() to UserRepository.

## 0.0.23
* Added unit tests for Message class.

## 0.0.22 2018-06-30

* Added isEmailAvailable to the UserRepository.
