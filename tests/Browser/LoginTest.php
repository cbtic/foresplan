<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Domains\Auth\Models\User;
use App\Providers\RouteServiceProvider;

class LoginTest extends DuskTestCase
{

    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {

        $this->browse(function (Browser $browser) {
            $user = User::factory()->create();

            $browser->logout()
                ->visit('/login')
                ->waitForInput('email')
                ->type('email', $user->email)
                ->type('password', 'v3ry_St5p1d')
                ->press('Iniciar sesión')
                ->waitForText('Las credenciales no se han encontrado.')
                ->assertGuest();
        });
    }

    public function testLogin()
    {

        $this->browse(function (Browser $browser) {
            $user = User::factory()->create();

            $browser->logout()
                ->visit('/login')
                ->waitForInput('email')
                ->type('email', $user->email)
                ->type('password', 'secret')
                ->press('Iniciar sesión')
                ->assertSee('Usted está conectado');
        });
    }
}
