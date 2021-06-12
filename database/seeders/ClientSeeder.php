<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::insert([
            ['name' => 'Gustavo', 'lastname' => 'Sarmiento', 'dni' => '28357177'],
            ['name' => 'Jose Luis', 'lastname' => 'Gonzales', 'dni' => '10339834'],
            ['name' => 'Maria Belen', 'lastname' => 'Mercado', 'dni' => '39885549'],
            ['name' => 'Sonia', 'lastname' => 'Carranza', 'dni' => '25225386'],
            ['name' => 'Natalia ', 'lastname' => 'Vazques', 'dni' => '33273413'],
            ['name' => 'Maria Belen', 'lastname' => 'Gonzalez', 'dni' => '33385226'],
            ['name' => 'Agustina', 'lastname' => 'Neyes', 'dni' => '44200510'],
            ['name' => 'Edith Elizabet', 'lastname' => 'Melian', 'dni' => '31771128'],
            ['name' => 'Maria', 'lastname' => 'Chavez', 'dni' => '_',],
            ['name' => 'Cecilia Isabel', 'lastname' => 'Ferreyra', 'dni' => '45588653'],
            ['name' => 'Rosa', 'lastname' => 'Rios de Gallos', 'dni' => '23475345'],
            ['name' => 'Villada', 'lastname' => 'Pool', 'dni' => '37187226'],
            ['name' => 'Juana Nicolasa', 'lastname' => 'Yacante', 'dni' => '23498284'],
            ['name' => 'Soledad', 'lastname' => 'Merlo', 'dni' => '30867899'],
            ['name' => 'Carlos Rafael', 'lastname' => 'Soria', 'dni' => '12569135'],
            ['name' => 'Celeste', 'lastname' => 'Sanchez', 'dni' => '36437378'],
            ['name' => 'Maria Isabel', 'lastname' => 'Quinteros', 'dni' => '23616449'],
            ['name' => 'Flavio Alberto', 'lastname' => 'Llanos', 'dni' => '24939432'],
            ['name' => 'Karen', 'lastname' => 'Romero', 'dni' => '39700910'],
            ['name' => 'Tamara ', 'lastname' => 'Lazarte', 'dni' => '37740099'],
            ['name' => 'Vanesa', 'lastname' => 'Aguilera', 'dni' => ''],
            ['name' => 'Adriana', 'lastname' => 'Vega', 'dni' => '29103990'],
            ['name' => 'Lorena del Valle', 'lastname' => 'Villegas', 'dni' => '31201391'],
            ['name' => 'Teodolina del Valle', 'lastname' => 'Quiroga', 'dni' => '6423494'],
            ['name' => 'Soledad', 'lastname' => 'Gomez', 'dni' => '_',],
            ['name' => 'Jessica ', 'lastname' => 'Atencio', 'dni' => '36503404'],
            ['name' => 'Yamila', 'lastname' => 'Reynoso', 'dni' => '36503200'],
            ['name' => 'Laura', 'lastname' => 'Lesme', 'dni' => '35233040'],
            ['name' => 'Jorge', 'lastname' => 'Julio', 'dni' => '_',],
            ['name' => 'Rocio Guadalupe', 'lastname' => 'Alcaraz', 'dni' => '36255809'],
            ['name' => 'Flavia', 'lastname' => 'Juarez', 'dni' => '32563725'],
            ['name' => 'Elena Isabel', 'lastname' => 'Luna', 'dni' => '21088046'],
            ['name' => 'Tamara ', 'lastname' => 'Barrionuevo', 'dni' => '39905190'],
            ['name' => 'Cristina', 'lastname' => 'Jofre', 'dni' => '23482954']
        ]);
    }
}
