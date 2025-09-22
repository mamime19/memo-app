import { createRouter, createWebHistory } from "vue-router";
import MemoPadPage from "@/pages/MemoPadPage.vue";
import MemoPage from "@/pages/MemoPage.vue";
import NotFound from "@/components/NotFound.vue";
import MainPage from "@/pages/MainPage.vue";
import Registrations from "@/pages/Registrations.vue";
import UserPage from "@/pages/UserPage.vue";

const routes = [
    {
        path: '/',
        name: 'Main',
        component: MainPage
    },
    {
        path: '/users/:id/memopads',
        name: 'User',
        component: UserPage
    },
    {
        path:'/registration',
        name: 'Registrations',
        component: Registrations
    },
    {
        path: '/memopads/:id/memos',
        name: 'Memopad',
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
