<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Tests\CreatesUser;
use Tests\InteractsWithDatabase;
use Illuminate\Support\Facades\Auth;

class AuthenticationTest extends TestCase
{
    use InteractsWithDatabase, CreatesUser;

    /** @test */
    public function it_validates_the_login_form()
    {
        // User entered nothing
        $this->visit(route('canvas.admin'))
            ->type('', 'email')
            ->type('', 'password')
            ->press('submit')
            ->dontSeeIsAuthenticated()
            ->seePageIs(route('canvas.admin'));
        $this->see('The email field is required.');
        $this->see('The password field is required.');

        // User entered incorrect email/password
        $this->visit(route('canvas.admin'))
            ->type('foo@bar.com', 'email')
            ->type('secret', 'password')
            ->press('submit')
            ->dontSeeIsAuthenticated()
            ->seePageIs(route('canvas.admin'));
        $this->see('These credentials do not match our records.');
    }

    /** @test */
    public function it_validates_the_forgot_password_form()
    {
        // $this->browse(function ($browser) {
        //     // User entered nothing
        //     $browser->visit(route('canvas.auth.password.forgot'))
        //         ->with('#forgot-password', function ($form) {
        //             $form->type('email', '')
        //                 ->press('submit');
        //         });
        //     $browser->assertTitleContains('Forgot Password')
        //         ->assertSee('The email field is required.');

        //     // User entered wrong email
        //     $browser->visit(route('canvas.auth.password.forgot'))
        //         ->with('#forgot-password', function ($form) {
        //             $form->type('email', 'foo@bar.com')
        //                 ->press('submit');
        //         });
        //     $browser->assertTitleContains('Forgot Password')
        //         ->assertSee('We can\'t find a user with that e-mail address.');
        // });
    }

    /** @test */
    public function it_can_login_to_the_application()
    {
        // $this->browse(function ($browser) {
        //     $browser->visit(route('canvas.admin'))
        //         ->with('#login', function ($form) {
        //             $form->type('email', $this->user->email)
        //                 ->type('password', 'password')
        //                 ->press('submit');
        //         });
        //     $browser->assertSee('Welcome to Canvas');
        // });
    }

    /** @test */
    public function it_can_logout_of_the_application()
    {
        // Auth::guard('canvas')->login($this->user);
        // $this->browse(function ($browser) {
        //     $browser->visit(route('canvas.admin'))
        //         ->clickLink('Sign out');

        //     $browser->assertTitleContains('Sign In');
        // });
    }
}
