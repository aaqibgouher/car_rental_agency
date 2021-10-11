import FrontendAuthPage from '../pages/frontend/FrontendAuthPage';
import FrontendLoginComponent from '../components/frontend/auth/FrontendLoginComponent';
import FrontendRegisterComponent from '../components/frontend/auth/FrontendRegisterComponent';
import FrontendHomePage from '../pages/frontend/FrontendHomePage';
import FrontendCarListComponent from '../components/frontend/cars/FrontendCarListComponent';
import AdminLogoutComponent from '../components/admin/auth/AdminLogoutComponent';
import FrontendBookingListComponent from '../components/frontend/cars/FrontendBookingListComponent';
import FrontendBookingHistoryComponent from '../components/frontend/cars/FrontendBookingHistoryComponent';

const routes = [
    {
        path: '/',
        component: FrontendHomePage,
        children: [
            {
                path: "",
                name: "frontend",
                component: FrontendCarListComponent
            },
            {
                path: "booking",
                name: "frontend_booking",
                component: FrontendBookingListComponent
            },
            {
                path: "history",
                name: "frontend_booking_history",
                component: FrontendBookingHistoryComponent
            },
        ]
    },
    {
        path: '/',
        name: 'frontend_auth',
        component: FrontendAuthPage,
        children: [
            {
                path: 'login',
                name: 'frontend_login',
                component: FrontendLoginComponent
            },
            {
                path: 'register',
                name: 'frontend_register',
                component: FrontendRegisterComponent
            },
            {
                path: 'logout',
                name: 'frontend_logout',
                component: AdminLogoutComponent
            }
        ]
    },
    
]

export default routes;