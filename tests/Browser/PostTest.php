<?php

namespace Tests\Browser;

use App\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PostTest extends DuskTestCase
{
    /**
     * A browser test create post.
     *
     * @return void
     * @throws \Throwable
     */
    public function testCreatePost()
    {
        $this->browse(function (Browser $browser) {

            $user = User::where('role', 'admin')->first();

            $browser->loginAs($user)
                ->visit('/post')
                ->assertSee('Guest book')
                ->type('text', 'blablabla')
                ->press('send')
                ->waitForText('blablabla');
        });
    }
}
