import { createRouter, createWebHistory } from "vue-router";
import MainPage from "@/pages/MainPage.vue";
import MemoPage from "@/pages/MemoPage.vue";
import NotFound from "@/components/NotFound.vue";

const routes = [
    {path:'/',component: MainPage},
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
