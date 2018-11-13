<?php

use App\Entity\User;
use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator as Crumbs;
use App\Entity\Region;
use App\Entity\Adverts\Advert\Advert;
use App\Entity\Banner\Banner;
use App\Entity\Ticket\Ticket;

Breadcrumbs::register('home', function (Crumbs $crumbs) {
    $crumbs->push('Home', route('home'));
});

//Auth
Breadcrumbs::register('login', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push('Login', route('login'));
});

Breadcrumbs::register('register', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push('Register', route('register'));
});

Breadcrumbs::register('password.request', function (Crumbs $crumbs) {
    $crumbs->parent('login');
    $crumbs->push('Reset Password', route('password.request'));
});

Breadcrumbs::register('password.reset', function (Crumbs $crumbs) {
    $crumbs->parent('password.request');
    $crumbs->push('Change', route('password.reset'));
});

//Cabinet
Breadcrumbs::register('cabinet.home', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push('Cabinet', route('cabinet.home'));
});

Breadcrumbs::register('cabinet.profile.home', function (Crumbs $crumbs) {
    $crumbs->parent('cabinet.home');
    $crumbs->push('Profile', route('cabinet.profile.home'));
});

Breadcrumbs::register('cabinet.profile.edit', function (Crumbs $crumbs) {
    $crumbs->parent('cabinet.profile.home');
    $crumbs->push('Edit', route('cabinet.profile.edit'));
});

// Cabinet Adverts
Breadcrumbs::register('cabinet.adverts.index', function (Crumbs $crumbs) {
    $crumbs->parent('cabinet.home');
    $crumbs->push('Adverts', route('cabinet.adverts.index'));
});

Breadcrumbs::register('cabinet.adverts.create', function (Crumbs $crumbs) {
    $crumbs->parent('adverts.index');
    $crumbs->push('Create', route('cabinet.adverts.create'));
});

Breadcrumbs::register('cabinet.adverts.create.region', function (Crumbs $crumbs, Region $region = null) {
    $crumbs->parent('cabinet.adverts.create');
    $crumbs->push('$category->name', route('cabinet.adverts.create.region', [$region]));//тут косяк
});

Breadcrumbs::register('cabinet.adverts.create.advert', function (Crumbs $crumbs, Region $region = null) {
    $crumbs->parent('cabinet.adverts.create.region', $region);
    $crumbs->push($region ? $region->name : 'All', route('cabinet.adverts.create.advert', [$region]));
});

// Cabinet Banners
Breadcrumbs::register('cabinet.banners.index', function (Crumbs $crumbs) {
    $crumbs->parent('cabinet.home');
    $crumbs->push('Banners', route('cabinet.banners.index'));
});

Breadcrumbs::register('cabinet.banners.show', function (Crumbs $crumbs, Banner $banner) {
    $crumbs->parent('cabinet.banners.index');
    $crumbs->push($banner->name, route('cabinet.banners.show', $banner));
});

Breadcrumbs::register('cabinet.banners.edit', function (Crumbs $crumbs, Banner $banner) {
    $crumbs->parent('cabinet.banners.show', $banner);
    $crumbs->push('Edit', route('cabinet.banners.edit', $banner));
});

Breadcrumbs::register('cabinet.banners.file', function (Crumbs $crumbs, Banner $banner) {
    $crumbs->parent('cabinet.banners.show', $banner);
    $crumbs->push('File', route('cabinet.banners.file', $banner));
});


Breadcrumbs::register('cabinet.banners.create.region', function (Crumbs $crumbs, Region $region = null) {
    $crumbs->parent('cabinet.banners.index');
    $crumbs->push('Новый банер', route('cabinet.banners.create.region', [$region]));
});

Breadcrumbs::register('cabinet.banners.create.banner', function (Crumbs $crumbs, Region $region = null) {
    $crumbs->parent('cabinet.banners.index', $region);
    $crumbs->push($region ? $region->name : 'Новый банер', route('cabinet.banners.create.banner', [$region]));
});

// Cabinet Tickets
Breadcrumbs::register('cabinet.tickets.index', function (Crumbs $crumbs) {
    $crumbs->parent('cabinet.home');
    $crumbs->push('Tickets', route('cabinet.tickets.index'));
});
Breadcrumbs::register('cabinet.tickets.create', function (Crumbs $crumbs) {
    $crumbs->parent('cabinet.tickets.index');
    $crumbs->push('Create', route('cabinet.tickets.create'));
});
Breadcrumbs::register('cabinet.tickets.show', function (Crumbs $crumbs, Ticket $ticket) {
    $crumbs->parent('cabinet.tickets.index');
    $crumbs->push($ticket->subject, route('cabinet.tickets.show', $ticket));
});

//Admin
Breadcrumbs::register('admin.home', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push('Admin', route('admin.home'));
});

Breadcrumbs::register('admin.adverts.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Categories', route('admin.adverts.index'));
});

Breadcrumbs::register('admin.adverts.edit', function (Crumbs $crumbs, Advert $advert) {
    $crumbs->parent('admin.home');
    $crumbs->push($advert->title, route('admin.adverts.edit', $advert));
});

Breadcrumbs::register('admin.adverts.reject', function (Crumbs $crumbs, Advert $advert) {
    $crumbs->parent('admin.home');
    $crumbs->push($advert->title, route('admin.adverts.reject', $advert));
});

Breadcrumbs::register('admin.adverts.photos', function (Crumbs $crumbs, Advert $advert) {
    $crumbs->parent('admin.home');
    $crumbs->push($advert->title, route('adverts.show', $advert));
    $crumbs->push('Фотки');
});

// Banners
Breadcrumbs::register('admin.banners.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Banners', route('admin.banners.index'));
});

Breadcrumbs::register('admin.banners.show', function (Crumbs $crumbs, Banner $banner) {
    $crumbs->parent('admin.banners.index');
    $crumbs->push($banner->name, route('admin.banners.show', $banner));
});

Breadcrumbs::register('admin.banners.edit', function (Crumbs $crumbs, Banner $banner) {
    $crumbs->parent('admin.banners.show', $banner);
    $crumbs->push('Edit', route('admin.banners.edit', $banner));
});

Breadcrumbs::register('admin.banners.reject', function (Crumbs $crumbs, Banner $banner) {
    $crumbs->parent('admin.banners.show', $banner);
    $crumbs->push('Reject', route('admin.banners.reject', $banner));
});

//Users
Breadcrumbs::register('admin.users.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Users', route('admin.users.index'));
});
Breadcrumbs::register('admin.users.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.users.index');
    $crumbs->push('Create', route('admin.users.create'));
});
Breadcrumbs::register('admin.users.show', function (Crumbs $crumbs, User $user) {
    $crumbs->parent('admin.users.index');
    $crumbs->push($user->name, route('admin.users.show', $user));
});
Breadcrumbs::register('admin.users.edit', function (Crumbs $crumbs, User $user) {
    $crumbs->parent('admin.users.show', $user);
    $crumbs->push('Edit', route('admin.users.edit', $user));
});

// Regions
Breadcrumbs::register('admin.regions.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Regions', route('admin.regions.index'));
});

Breadcrumbs::register('admin.regions.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.regions.index');
    $crumbs->push('Create', route('admin.regions.create'));
});

Breadcrumbs::register('admin.regions.show', function (Crumbs $crumbs, Region $region) {
    if ($parent = $region->parent) {
        $crumbs->parent('admin.regions.show', $parent);
    } else {
        $crumbs->parent('admin.regions.index');
    }
    $crumbs->push($region->name, route('admin.regions.show', $region));
});

Breadcrumbs::register('admin.regions.edit', function (Crumbs $crumbs, Region $region) {
    $crumbs->parent('admin.regions.show', $region);
    $crumbs->push('Edit', route('admin.regions.edit', $region));
});

// Adverts
Breadcrumbs::register('adverts.index.all', function (Crumbs $crumbs, Region $region = null) {
    $crumbs->parent('home');
    $crumbs->push('Adverts', route('adverts.index.all'));
});

Breadcrumbs::register('adverts.inner_region', function (Crumbs $crumbs, Region $region = null) {//это вспомогательная крошка
    if ($region && $parent = $region->parent) {
        $crumbs->parent('adverts.inner_region', $parent);
    } else {
        $crumbs->parent('home');
        $crumbs->push('Adverts', route('adverts.index'));
    }

    if ($region) {
        $crumbs->push($region->name, route('adverts.index', $region));
    }
});

Breadcrumbs::register('adverts.index', function (Crumbs $crumbs, Region $region = null) {
    $crumbs->parent('adverts.inner_region', $region);
});

Breadcrumbs::register('adverts.show', function (Crumbs $crumbs, Advert $advert) {
    $crumbs->parent('adverts.index', $advert->region, $advert->category);
    $crumbs->push($advert->title, route('adverts.show', $advert));
});

// Tickets
Breadcrumbs::register('admin.tickets.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Tickets', route('admin.tickets.index'));
});
Breadcrumbs::register('admin.tickets.show', function (Crumbs $crumbs, Ticket $ticket) {
    $crumbs->parent('admin.tickets.index');
    $crumbs->push($ticket->subject, route('admin.tickets.show', $ticket));
});
Breadcrumbs::register('admin.tickets.edit', function (Crumbs $crumbs, Ticket $ticket) {
    $crumbs->parent('admin.tickets.show', $ticket);
    $crumbs->push('Edit', route('admin.tickets.edit', $ticket));
});

