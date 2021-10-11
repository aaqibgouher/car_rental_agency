import VueRouter from 'vue-router';
import adminRoutes from './adminRoutes';
import frontendRoutes from './frontendRoutes';

const routes = [
    ...adminRoutes,
    ...frontendRoutes
];

export const router = new VueRouter({
    
    routes,
    mode: 'history'
    
})