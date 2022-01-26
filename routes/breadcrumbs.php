<?php
// Home
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push(__('breadcrumbs.Home'), route('dashboard'));
});

// Forms
Breadcrumbs::for('forms.list', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(__('breadcrumbs.Forms'), route('forms.list'));
});

// Forms detail
Breadcrumbs::for('forms.detail', function ($trail, $form) {
    $trail->parent('forms.list');
    $trail->push($form->name, route('forms.detail', $form->id));
});

// Forms create
Breadcrumbs::for('forms.create', function ($trail) {
    $trail->parent('forms.list');
    $trail->push(__('breadcrumbs.Form_create'), route('forms.create'));
});

// Forms create
Breadcrumbs::for('forms.edit', function ($trail, $form) {
    $trail->parent('forms.list');
    $trail->push(__('breadcrumbs.Form_edit').'«‎'.$form->name.'»', route('forms.edit', $form->id));
});

// Resume
Breadcrumbs::for('resume.list', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(__('breadcrumbs.Resume'), route('resume.list'));
});

// Resume detail
Breadcrumbs::for('resume.detail', function ($trail, $resume) {
    $trail->parent('resume.list');
    $trail->push($resume->fullname, route('resume.detail', $resume->id));
});

// Interviews
Breadcrumbs::for('interviews.list', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(__('breadcrumbs.Interviews'), route('interviews.list'));
});

// Interviews detail
Breadcrumbs::for('interviews.detail', function ($trail, $interview, $interviewId) {
    $trail->parent('interviews.list');
    $trail->push($interview, route('interviews.detail', $interviewId));
});


// Tests
Breadcrumbs::for('tests.list', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(__('breadcrumbs.Tests'), route('tests.list'));
});


// Tests detail
Breadcrumbs::for('tests.detail', function ($trail, $test) {
    $trail->parent('tests.list');
    $trail->push($test->name, route('tests.detail', $test->id));
});


// questions
Breadcrumbs::for('questions.list', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(__('breadcrumbs.Questions'), route('questions.list'));
});

// questions edit
Breadcrumbs::for('questions.edit', function ($trail, $question) {
    $trail->parent('questions.list');
    $trail->push(__('breadcrumbs.Question_edit'), route('questions.edit', $question->id));
});


// questions detail
Breadcrumbs::for('questions.detail', function ($trail, $question) {
    $trail->parent('questions.list');
    $trail->push($question->question, route('questions.detail', $question->id));
});

