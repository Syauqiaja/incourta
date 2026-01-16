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
    $trail->parent('admin.events.index');
    $trail->push('Create Event', route('admin.events.create'));
});
Breadcrumbs::for('admin.events.edit', function (BreadcrumbTrail $trail, $event) {
    $trail->parent('admin.events.index');
    $trail->push('Edit: ' . $event->title, route('admin.events.edit', $event->id));
});
Breadcrumbs::for('admin.events.show', function (BreadcrumbTrail $trail, $event) {
    $trail->parent('admin.events.index');
    $trail->push($event->title, route('admin.events.show', $event->id));
});