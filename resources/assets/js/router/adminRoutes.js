import AdminAuthPage from '../pages/admin/AdminAuthPage';
import AdminLoginComponent from '../components/admin/auth/AdminLoginComponent';
import AdminRegisterComponent from '../components/admin/auth/AdminRegisterComponent';
import AdminHomePage from '../pages/admin/AdminHomePage';
import AdminDashboardComponent from '../components/AdminDashboardComponent';
import AdminCarsListComponent from '../components/cars/AdminCarsListComponent';
import AdminCarAddComponent from '../components/cars/AdminCarAddComponent';
import AdminCarEditComponent from '../components/cars/AdminCarEditComponent';
import AdminBookedCarsListComponent from '../components/cars/AdminBookedCarsListComponent';
import AdminProfileComponent from '../components/admin/profile/AdminProfileComponent';
import AdminLogoutComponent from '../components/admin/auth/AdminLogoutComponent';

const routes = [
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
                name: 'admin_cars_list',
                component: AdminCarsListComponent
            },
            {
                path: 'cars/add',
                name: 'admin_car_add',
                component: AdminCarAddComponent
            },
            {
                path: 'cars/edit/:id',
                name: 'admin_car_edit',
                component: AdminCarEditComponent
            },
            ,
            {
                path: 'booked_cars',
                name: 'admin_booked_cars_list',
                component: AdminBookedCarsListComponent
            },
            {
                path: 'profile',
                name: 'admin_profile',
                component: AdminProfileComponent
            },
        ]
    },
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
            },
            {
                path: 'logout',
                name: 'admin_logout',
                component: AdminLogoutComponent
            },
        ]
    },
    
]

export default routes;