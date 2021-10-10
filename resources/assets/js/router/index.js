import VueRouter from 'vue-router';
import adminRoutes from './adminRoutes';

const routes = [
    ...adminRoutes
];

export const router = new VueRouter({
    
    routes,
    mode: 'history'
    
})