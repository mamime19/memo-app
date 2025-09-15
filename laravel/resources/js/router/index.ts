import { createRouter, createWebHistory } from "vue-router";
import { routes } from "vue-router/auto-routes";
import MainPage from "@/components/MainPage.vue";
import MemoPage from "@/components/MemoPage.vue";

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
