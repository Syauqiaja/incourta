<?php // routes/breadcrumbs.php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('admin.home.index', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('admin.home.index'));
});
Breadcrumbs::for('admin.events.index', function (BreadcrumbTrail $trail) {
    $trail->push('Events', route('admin.events.index'));
});
Breadcrumbs::for('admin.events.create', function (BreadcrumbTrail $trail) {
    $trail->push('Create Event', route('admin.events.create'));
});
Breadcrumbs::for('admin.events.show', function (BreadcrumbTrail $trail) {
    $trail->push('Detail', route('admin.events.show'));
});