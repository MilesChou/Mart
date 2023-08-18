<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CustomerQuestion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Laravel\Pennant\Feature;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CustomerQuestionTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function onlyAdminsCanGoToAdminView()
    {
        Artisan::call('db:seed');
        Auth::loginUsingId(1); //admin according to the seeder

        $response = $this->get('/admin/customer-question');
        $response->assertStatus(200);
    }

    #[Test]
    public function usersAreRestrictedToGoToAdminView()
    {
        Artisan::call('db:seed');
        Auth::loginUsingId(2); //user according to the seeder

        $response = $this->get('/admin/customer-question');
        $response->assertForbidden();
    }

    #[Test]
    public function userCanStoreQuestionToProduct()
    {
        Artisan::call('db:seed');
        Auth::loginUsingId(3); //user according to the seeder

        $response = $this->post('/customer-question', [
            'question' => 'Is is good?',
            'product_id' => 1,
        ]);
        $response->assertStatus(302);
        $this->assertCount(1, CustomerQuestion::all());
    }

    #[Test]
    public function seeCustomerQuestionWhenFeatureOn()
    {
        Artisan::call('db:seed');
        Auth::loginUsingId(4); //user according to the seeder

        Feature::for(Auth::user())->activate('customer_question');

        $this->get('/user')
            ->assertSeeText('My queries');
    }

    #[Test]
    public function dontSeeCustomerQuestionWhenFeatureOff()
    {
        Artisan::call('db:seed');
        Auth::loginUsingId(4); //user according to the seeder

        Feature::for(Auth::user())->deactivate('customer_question');

        $this->get('/user')
            ->assertDontSeeText('My queries');
    }
}
