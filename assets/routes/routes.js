import VueRouter from 'vue-router';

import Dashboard from '../components/Dashboard';

import Entry from '../components/entry/Entry';
import Entries from '../components/entry/Entries';
import CreateEntry from '../components/entry/CreateEntry';

const routes = [
    {
        name: 'root',
        path: '/',
        redirect: {
            name: 'dashboard'
        }
    },
    {
        name: 'dashboard',
        path: '/dashboard',
        component: Dashboard,
        children: []
    },
    {
        name: 'entry',
        path: '/entry',
        component: Entry,
        redirect: {
            name: 'entries'
        },
        children: [
            { name: 'entries', path: '/entries', component: Entries },
            { name: 'add-entry', path: '/add-entry', component: CreateEntry, props: { isEditMode: false } },
            { name: 'edit-entry', path: '/edit-entry', component: CreateEntry, props: { isEditMode: true, entry: undefined } },
        ]
    },
];

export default new VueRouter({
    base: 'admin',
    routes: routes
});