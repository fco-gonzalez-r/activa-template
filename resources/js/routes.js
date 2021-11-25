export const routes = [
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/user', component: require('./components/User/Users.vue').default },
    { path: '/roles', component: require('./components/Role/Roles.vue').default },
    { path: '*', component: require('./components/NotFound.vue').default }
];