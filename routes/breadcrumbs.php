<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

Breadcrumbs::for('series.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Series', route('series.index'));
});

