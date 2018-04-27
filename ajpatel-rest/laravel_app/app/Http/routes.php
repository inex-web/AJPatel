<?php
Route::group(['prefix' => 'api'], function() {
	Route::post('login',['uses'=>'HomeController@login']);
	
	Route::group(['middleware' => 'api_auth'], function() {
		Route::post('logout', ['uses' => 'HomeController@logout']);
		Route::post('password_change', ['uses' => 'HomeController@password_change']);
		Route::post('admin_view',['uses'=>'HomeController@admin_view']);
		Route::post('admin_edit',['uses'=>'HomeController@admin_edit']);
		
		Route::post('party_list',['uses'=>'PartyController@party_list']);
		Route::post('party_view',['uses'=>'PartyController@party_view']);
		Route::post('party_create', ['uses' => 'PartyController@party_create']);
		Route::post('party_edit', ['uses' => 'PartyController@party_edit']);
		
		Route::post('product_list',['uses'=>'ProductController@product_list']);
		Route::post('product_create', ['uses' => 'ProductController@product_create']);
		Route::post('product_edit', ['uses' => 'ProductController@product_edit']);

		Route::post('invoice_list',['uses'=>'InvoiceController@invoice_list']);
		Route::post('invoice_create',['uses'=>'InvoiceController@invoice_create']);
		Route::post('invoice_view',['uses'=>'InvoiceController@invoice_view']);
		
	});
});

?>