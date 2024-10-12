/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// CoreUI
require('@coreui/coreui');

require('../bootstrap');
require('../plugins');

require('@fullcalendar/core');

import { Calendar } from '@fullcalendar/core';
window.Calendar = Calendar;

import interaction from '@fullcalendar/interaction';
window.interactionPlugin = interaction;

import dayGridPlugin from '@fullcalendar/daygrid';
window.dayGridPlugin = dayGridPlugin;

import timeGridPlugin from '@fullcalendar/timegrid';
window.timeGridPlugin = timeGridPlugin;

import listPlugin from '@fullcalendar/list';
window.listPlugin = listPlugin;

import Vue from 'vue';

import introPlugin from 'intro.js';
window.introPlugin = introPlugin;

var tooltip = require('tooltip')

tooltip()

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});


document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new Calendar(calendarEl, {
        plugins: [interactionPlugin, dayGridPlugin, timeGridPlugin, listPlugin],
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        initialDate: '2018-01-12',
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        dayMaxEvents: true, // allow "more" link when too many events
        events: [{
                title: 'All Day Event',
                start: '2018-01-01',
            },
            {
                title: 'Long Event',
                start: '2018-01-07',
                end: '2018-01-10'
            },
            {
                groupId: 999,
                title: 'Repeating Event',
                start: '2018-01-09T16:00:00'
            },
            {
                groupId: 999,
                title: 'Repeating Event',
                start: '2018-01-16T16:00:00'
            },
            {
                title: 'Conference',
                start: '2018-01-11',
                end: '2018-01-13'
            },
            {
                title: 'Meeting',
                start: '2018-01-12T10:30:00',
                end: '2018-01-12T12:30:00'
            },
            {
                title: 'Lunch',
                start: '2018-01-12T12:00:00'
            },
            {
                title: 'Meeting',
                start: '2018-01-12T14:30:00'
            },
            {
                title: 'Happy Hour',
                start: '2018-01-12T17:30:00'
            },
            {
                title: 'Dinner',
                start: '2018-01-12T20:00:00'
            },
            {
                title: 'Birthday Party',
                start: '2018-01-13T07:00:00'
            },
            {
                title: 'Click for Google',
                url: 'http://google.com/',
                start: '2018-01-28'
            }
        ]
    });

    calendar.render();
});
