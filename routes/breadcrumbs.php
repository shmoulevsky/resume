<?php
// Home
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Главная', route('dashboard'));
});

// Forms
Breadcrumbs::for('forms.list', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Формы', route('forms.list'));
});

// Forms detail
Breadcrumbs::for('forms.detail', function ($trail, $form) {
    $trail->parent('forms.list');
    $trail->push($form->name, route('forms.detail', $form->id));
});

// Forms create
Breadcrumbs::for('forms.create', function ($trail) {
    $trail->parent('forms.list');
    $trail->push('Создание формы', route('forms.create'));
});

// Forms create
Breadcrumbs::for('forms.edit', function ($trail, $form) {
    $trail->parent('forms.list');
    $trail->push('Редактирование формы «‎'.$form->name.'»', route('forms.edit', $form->id));
});

// Resume
Breadcrumbs::for('resume.list', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Резюме', route('resume.list'));
});

// Resume detail
Breadcrumbs::for('resume.detail', function ($trail, $resume) {
    $trail->parent('resume.list');
    $trail->push($resume->fullname, route('resume.detail', $resume->id));
});

// Interviews
Breadcrumbs::for('interviews.list', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Собеседования', route('interviews.list'));
});
 
// Interviews detail
Breadcrumbs::for('interviews.detail', function ($trail, $interview, $interviewId) {
    $trail->parent('interviews.list');
    $trail->push($interview, route('interviews.detail', $interviewId));
});


// Tests
Breadcrumbs::for('tests.list', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Тесты', route('tests.list'));
});


// Tests detail
Breadcrumbs::for('tests.detail', function ($trail, $test) {
    $trail->parent('tests.list');
    $trail->push($test->name, route('tests.detail', $test->id));
});


// questions
Breadcrumbs::for('questions.list', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Банк вопросов', route('questions.list'));
});

// questions edit
Breadcrumbs::for('questions.edit', function ($trail, $question) {
    $trail->parent('questions.list');
    $trail->push('Редактирование вопроса', route('questions.edit', $question->id));
});


// questions detail
Breadcrumbs::for('questions.detail', function ($trail, $question) {
    $trail->parent('questions.list');
    $trail->push($question->question, route('questions.detail', $question->id));
});

