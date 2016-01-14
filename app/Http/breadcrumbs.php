<?php
// Home
Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('Home', url('/'));
});

Breadcrumbs::register('dashboard', function($breadcrumbs)
{
	$breadcrumbs->parent('home');
    $breadcrumbs->push('Dashboard', url('/'));
});

// Home > About
Breadcrumbs::register('admin', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Admin', url('/'));
});

// Home > Blog
Breadcrumbs::register('setup_customer', function($breadcrumbs)
{
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('Setup Customer', url('/front/customers'));
});
Breadcrumbs::register('setup_user', function($breadcrumbs)
{
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('Setup User', url('/front/users'));
});
Breadcrumbs::register('add_customer', function($breadcrumbs)
{
    $breadcrumbs->parent('setup_customer');
    $breadcrumbs->push('Add Customer', url('/front/customers/add'));
});
Breadcrumbs::register('add_user', function($breadcrumbs)
{
    $breadcrumbs->parent('setup_user');
    $breadcrumbs->push('Add user', url('/front/users/add'));
});
Breadcrumbs::register('edit_customer', function($breadcrumbs)
{
    $breadcrumbs->parent('setup_customer');
    $breadcrumbs->push('Edit Customer', url('/front/customers/edit/'));
});

// Home > Accounting
Breadcrumbs::register('accounting', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Accounting', url('#'));
});
Breadcrumbs::register('shop_rates', function($breadcrumbs)
{
    $breadcrumbs->parent('accounting');
    $breadcrumbs->push('Shop Rate', url('/front/rates'));
});
Breadcrumbs::register('carrier_connectivity', function($breadcrumbs)
{
    $breadcrumbs->parent('accounting');
    $breadcrumbs->push('Setup Carrier Connectivity', url('/front/setup-connectivity'));
});
Breadcrumbs::register('add_carrier', function($breadcrumbs)
{
    $breadcrumbs->parent('carrier_connectivity');
    $breadcrumbs->push('Add Carrier', url('/front/setup-connectivity/add-carrier'));
});

// Home > Accounting
Breadcrumbs::register('update_profile', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Update Profile', url('/front/users/profile'));
});