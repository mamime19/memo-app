import { createRouter, createWebHistory } from "vue-router";
import MemoPadPage from "@/pages/MemoPadPage.vue";
import MemoPage from "@/pages/MemoPage.vue";
import NotFound from "@/components/NotFound.vue";
import MainPage from "@/pages/MainPage.vue";
import Registrations from "@/pages/Registrations.vue";
import UserPage from "@/pages/UserPage.vue";
import Login from "@/pages/Login.vue";

const routes = [
    {
        path: '/',
        name: 'Main',
        component: MainPage
    },
    {
        path: '/users/:user_id/memopads',
        name: 'User',
        component: UserPage
    },
    {
        path:'/registration',
        name: 'Registrations',
        component: Registrations
    },
    {
        path:'/login',
        name:'Login',
        component: Login
    },
    {
        path: '/users/:user_id/memopads/:memopad_id/memos',
        name: 'Memo',
        component: MemoPage
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'NotFound',
        component: NotFound
    }
]

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
