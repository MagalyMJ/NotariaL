<?php

use Illuminate\Database\Seeder;
use Bican\Roles\Models\Permission;
use Bican\Roles\Models\Role;


class RoleAndPermicions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
         Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'description' => 'Tiene acceso y permiso total sobre la aplicacion', 
            'level' => 1
        ]);

        Role::create([
            'name' => 'Moderator',
            'slug' => 'moderator',
            'description' => 'permisos de edicion,creacion y eliminacion de tramites', // optional
            'level' => 2
        ]);
        Role::create([
            'name' => 'User',
            'slug' => 'user',
            'description' => 'Permisos de creacion de clientes, permisos de lectura', 
            'level' => 3
        ]);

//Permisos de Usuarios
	 	Permission::create([
		    'name' => 'Create users',
		    'slug' => 'create.users',
		    'description' => 'Crear nuevos Usuarios', // optional
		]);

		Permission::create([
		    'name' => 'Delete users',
		    'slug' => 'delete.users',
		    'description' => 'Eliminar Usuarios', // optional

		]);
		 Permission::create([
		    'name' => 'Edit users',
		    'slug' => 'edit.users',
		    'description' => 'Editar Usuarios', // optional

		]);
//Permisos de Tramites
	 	 Permission::create([
		    'name' => 'Crear Tramite',
		    'slug' => 'create.tramite',
		    'description' => 'Crear nuevos Tramites', // optional
		]);

		Permission::create([
		    'name' => 'Delete Tramite',
		    'slug' => 'delete.tramite',
		    'description' => 'Eliminar Tramite', // optional

		]);
		 Permission::create([
		    'name' => 'Edit Tramite',
		    'slug' => 'edit.tramite',
		    'description' => 'Editar Tramite', // optional

		]);
//Permisos de Clientes
	 	 Permission::create([
		    'name' => 'Crear Clientes',
		    'slug' => 'create.clientes',
		    'description' => 'Crear nuevos Clientes', // optional
		]);

		Permission::create([
		    'name' => 'Delete Clientes',
		    'slug' => 'delete.clientes',
		    'description' => 'Eliminar Clientes', // optional

		]);
		 Permission::create([
		    'name' => 'Edit Clientes',
		    'slug' => 'edit.clientes',
		    'description' => 'Editar Clientes', // optional

		]);
//Permisos de Presupuesto 
	 	 Permission::create([
		    'name' => 'Crear Budget',
		    'slug' => 'create.budget',
		    'description' => 'Crear nuevos Presupuestos', // optional
		]);

		Permission::create([
		    'name' => 'Delete Budget',
		    'slug' => 'delete.budget',
		    'description' => 'Eliminar Presupuestos', // optional

		]);
		 Permission::create([
		    'name' => 'Edit Budget',
		    'slug' => 'edit.budget',
		    'description' => 'Editar Presupuestos', // optional

		]);
//Permisos de Pagos 
	 	 Permission::create([
		    'name' => 'Crear Pagos',
		    'slug' => 'create.pagos',
		    'description' => 'Crear nuevos Pagos', // optional
		]);

		Permission::create([
		    'name' => 'Delete Pagos',
		    'slug' => 'delete.pagos',
		    'description' => 'Eliminar Pagos', // optional

		]);
		 Permission::create([
		    'name' => 'Edit Pagos',
		    'slug' => 'edit.pagos',
		    'description' => 'Editar Pagos', // optional

		]);


    }
}
