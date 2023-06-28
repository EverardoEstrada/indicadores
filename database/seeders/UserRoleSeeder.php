<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Models\User;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'Jefe de Area']);
        Role::create(['name' => 'Coordinador']);
        Role::create(['name' => 'Asesor']);

        User::create([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => hash::make('admin'),
        ])->assignRole('admin');

        User::create([
            'name' => 'IBARRA CASTILLO JUAN CARLOS',
            'email' => 'carlos.castillo@uaslp.mx',
            'password' => hash::make('pass'),
        ])->assignRole(['Jefe de Area','Asesor']);

        User::create([
            'name' => 'CARDENAS MARTINEZ ANGEL ISMAEL',
            'email' => 'angel.cardenas@uaslp.mx',
            'password' => hash::make('pass'),
        ])->assignRole(['Coordinador','Asesor']);

        User::create([
            'name' => 'GOMEZ RUBIO ANDRES',
            'email' => 'agomezr@uaslp.mx',
            'password' => hash::make('pass'),
        ])->assignRole('Asesor');

        User::create([
            'name' => 'ROCHA ESCALANTE HERMANN',
            'email' => 'correo1@uaslp.mx',
            'password' => hash::make('pass'),
        ])->assignRole('Asesor');

        User::create([
            'name' => 'RODRIGUEZ CUEVAS CLEMENTE',
            'email' => 'correo2@uaslp.mx',
            'password' => hash::make('pass'),
        ])->assignRole('Asesor');

        User::create([
            'name' => 'DIAZ QUIÑONES LILIA DEL CARMEN',
            'email' => 'diaquili@uaslp.mx',
            'password' => hash::make('pass'),
        ])->assignRole('Asesor');

        User::create([
            'name' => 'ARAIZA RODRIGUEZ JUAN ANTONIO',
            'email' => 'correo3@uaslp.mx',
            'password' => hash::make('pass'),
        ])->assignRole('Asesor');

        User::create([
            'name' => 'PULIDO DELGADO JOSE LUIS MARTIN',
            'email' => 'correo4@uaslp.mx',
            'password' => hash::make('pass'),
        ])->assignRole('Asesor');

        User::create([
            'name' => 'RIVERA JUAREZ JULIO',
            'email' => 'correo5@uaslp.mx',
            'password' => hash::make('pass'),
        ])->assignRole('Asesor');

        User::create([
            'name' => 'PUENTE NAVARRO JOSE DE JESUS',
            'email' => 'correo6@uaslp.mx',
            'password' => hash::make('pass'),
        ])->assignRole('Asesor');

        User::create([
            'name' => 'DUFOUR CANDELARIA ARTURO',
            'email' => 'correo7@uaslp.mx',
            'password' => hash::make('pass'),
        ])->assignRole('Asesor');

        User::create([
            'name' => 'PEREZ GONZALEZ JORGE ALBERTO',
            'email' => 'correo8@uaslp.mx',
            'password' => hash::make('pass'),
        ])->assignRole('Asesor');

        User::create([
            'name' => 'RODRIGUEZ ROBLEDO JORGE ALBERTO',
            'email' => 'correo9@uaslp.mx',
            'password' => hash::make('pass'),
        ])->assignRole('Asesor');

        User::create([
            'name' => 'BENAVENTE LEIJA JAVIER',
            'email' => 'correo10@uaslp.mx',
            'password' => hash::make('pass'),
        ])->assignRole('Asesor');

        User::create([
            'name' => 'SARABIA MELENDEZ IRMA FRANCISCA',
            'email' => 'correo11@uaslp.mx',
            'password' => hash::make('pass'),
        ])->assignRole('Asesor');

        User::create([
            'name' => 'VAZQUEZ RAMOS VICTOR',
            'email' => 'correo12@uaslp.mx',
            'password' => hash::make('pass'),
        ])->assignRole('Asesor');

        User::create([
            'name' => 'MARTINEZ HERNANDEZ SALVADOR',
            'email' => 'correo13@uaslp.mx',
            'password' => hash::make('pass'),
        ])->assignRole('Asesor');

        User::create([
            'name' => 'SANDOVAL MEDINA MIRNA',
            'email' => 'correo14@uaslp.mx',
            'password' => hash::make('pass'),
        ])->assignRole('Asesor');

        User::create([
            'name' => 'MONTOYA ESPINOZA MA. ERNESTINA',
            'email' => 'correo15@uaslp.mx',
            'password' => hash::make('pass'),
        ])->assignRole('Asesor');

        User::create([
            'name' => 'JAIME CARREON JUAN ANTONIO',
            'email' => 'correo16@uaslp.mx',
            'password' => hash::make('pass'),
        ])->assignRole('Asesor');

        User::create([
            'name' => 'GONZALEZ ORTIZ LUIS ARTURO',
            'email' => 'correo@uaslp.mx',
            'password' => hash::make('pass'),
        ])->assignRole('Asesor');

        User::create([
            'name' => 'CAMPOS JUAREZ JORGE',
            'email' => 'correo17@uaslp.mx',
            'password' => hash::make('pass'),
        ])->assignRole('Asesor');

        User::create([
            'name' => 'BETANCOURT URBINA MARIO ALBERTO',
            'email' => 'correo18@uaslp.mx',
            'password' => hash::make('pass'),
        ])->assignRole('Asesor');

        User::create([
            'name' => 'NAVARRETE MACIAS DANTE',
            'email' => 'correo19@uaslp.mx',
            'password' => hash::make('pass'),
        ])->assignRole('Asesor');

        User::create([
            'name' => 'DE VELÁZQUEZ FARFÁN EMMA LUZ',
            'email' => 'correo20@uaslp.mx',
            'password' => hash::make('pass'),
        ])->assignRole('Asesor');

        User::create([
            'name' => 'BORSELLI  LORENZO',
            'email' => 'correo21@uaslp.mx',
            'password' => hash::make('pass'),
        ])->assignRole('Asesor');

        User::create([
            'name' => 'ESCOBEDO MARTINEZ GUILLERMO',
            'email' => 'guillermo@uaslp.mx',
            'password' => hash::make('pass'),
        ])->assignRole('Asesor');

        User::create([
            'name' => 'MARTINEZ TISCAREÑO ADRIANA',
            'email' => 'correo22@uaslp.mx',
            'password' => hash::make('pass'),
        ])->assignRole('Asesor');

        User::create([
            'name' => 'VAZQUEZ CASTILLO ERIKA DEL CARMEN',
            'email' => 'correo23@uaslp.mx',
            'password' => hash::make('pass'),
        ])->assignRole('Asesor');








    }
}
