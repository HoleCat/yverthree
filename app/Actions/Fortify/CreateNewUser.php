<?php

namespace App\Actions\Fortify;

use App\Models\Store;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        $store = new Store();
        $store->store = $user->name." Acid Jelly";
        $store->logo = "missing";
        $store->slogan = "the new slogan for my new store";
        $store->background_one = "#F44336";
        $store->background_two = "#00ffd9";
        $store->background_three = "#00ffd9";
        $store->background_products = "#00ffd9";
        $store->background_categories = "#00ffd9";
        $store->color_title_principal = "#212121";
        $store->color_title_secondary = "#212121";
        $store->color_product_price = "#212121";
        $store->color_product_categorie = "#212121";
        $store->color_product_discount = "#212121";
        $store->color_product_stock = "#212121";
        $store->background_product_price = "#212121";
        $store->background_product_categorie = "#212121";
        $store->background_product_discount = "#212121";
        $store->background_product_stock = "#212121";
        $store->color_product_alert = "#212121";
        $store->color_product_info = "#212121";
        $store->color_product_description = "#212121";
        $store->radio_options = "#212121";
        $store->user_id = $user->id;
        $store->save();

        return $user;
    }
}
