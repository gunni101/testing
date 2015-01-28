<?php
return array(
    'bjyauthorize' => array(
        // Using the authentication identity provider, which basically reads the roles from the auth service's identity
        'identity_provider' => 'BjyAuthorize\Provider\Identity\AuthenticationIdentityProvider',
        'default_role' => 'guest',
        'role_providers'        => array(
            // this will load roles from the user_role table in a database
            // format: user_role(role_id(varchar], parent(varchar))
            'BjyAuthorize\Provider\Role\ZendDb' => array(
                'table' => 'role',
                'identifier_field_name' => 'id',
                'role_id_field' => 'roleId',
                'parent_role_field' => 'parent_id',
            ),
            // using an object repository (entity repository) to load all roles into our ACL
            'BjyAuthorize\Provider\Role\ObjectRepositoryProvider' => array(
                'object_manager'    => 'doctrine.entity_manager.orm_default',
                'role_entity_class' => 'User\Entity\Role',
            ),
        ),
        'guards' => array(
            'BjyAuthorize\Guard\Route' => array(
                array('route' => 'zfcuser', 'roles' => array('user')),
                array('route' => 'zfcuser/logout', 'roles' => array('user')),
                array('route' => 'zfcuser/login', 'roles' => array('guest')),
                array('route' => 'zfcuser/register', 'roles' => array('guest')),
                array('route' => 'zfcuser/changeemail', 'roles' => array('user')),
                array('route' => 'zfcuser/changepassword', 'roles' => array('user')),
                array('route' => 'fuelstation', 'roles' => array('user')),
                array('route' => 'home', 'roles' => array('guest', 'user', 'admin')),
            ),
        ),
    ),
);