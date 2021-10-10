import AdminAuthPage from '../pages/admin/AdminAuthPage';
import AdminLoginComponent from '../components/admin/auth/AdminLoginComponent';
import AdminRegisterComponent from '../components/admin/auth/AdminRegisterComponent';
import AdminHomePage from '../pages/admin/AdminHomePage';
import AdminDashboardComponent from '../components/AdminDashboardComponent';
import AdminCarsListComponent from '../components/cars/AdminCarsListComponent';

const routes = [
    {
        path: '/admin',
        name: 'admin_auth',
        component: AdminAuthPage,
        children: [
            {
                path: 'login',
                name: 'admin_login',
                component: AdminLoginComponent
            },
            {
                path: 'register',
                name: 'admin_register',
                component: AdminRegisterComponent
            }
        ]
    },
    {
        path: '/admin',
        component: AdminHomePage,
        children: [
            {
                path: '',
                name: 'admin',
                redirect: { name: 'admin_dashboard' }
            },
            {
                path: 'dashboard',
                name: 'admin_dashboard',
                component: AdminDashboardComponent
            },
            {
                path: 'cars',
                name: 'admin_cars',
                component: AdminCarsListComponent
            },
        ]
    }
]

export default routes;