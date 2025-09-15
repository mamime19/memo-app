import { createRouter, createWebHistory } from "vue-router";
import { routes } from "vue-router/auto-routes";
import MainPage from "@/pages/MainPage.vue";
import MemoPage from "@/pages/MemoPage.vue";

const routes = [
    {path:'/',component: MainPage},
    {
        path: '/memopads/:id/memos',
        name: 'Memopad',
        component: MemoPage
    }
]

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
