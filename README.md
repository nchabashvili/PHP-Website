# DBWS #7



## Description

Website that focuses on making deliveries from pharmacies.

# Entities
|name|description|
|----|-----------|
|Users|creating a base entity to be used in other more complex entities with features of having first and last names and email address|
|Courier|extension of the User entity with added feature of having a vehicle|
|Customer|extension of the User entity with added feature of having an address|
|Pharmacy|entity containing names and locations of pharmacies|
|Drugs|entity containing names and prices of drugs|


# Relationships
|name|description|
|----|-----------|
|DeliversFrom|`Courier` **DeliversFrom** `Pharmacy`|
|HasInStock|`Pharmacy` **HasInStock** `Drugs`|


## Features

- create and list couriers
- create and list customers
- create and list pharmacies
- create and list drugs
- search system
