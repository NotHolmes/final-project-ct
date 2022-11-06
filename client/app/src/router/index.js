import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import CoinDeskView from '@/views/CoinDeskView.vue'

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'home',
            component: HomeView
        },
        {
            path: '/about',
            name: 'about',
            // route level code-splitting
            // this generates a separate chunk (About.[hash].js) for this route
            // which is lazy-loaded when the route is visited.
            component: () => import('../views/AboutView.vue')
        },
        {
            path: '/coin-desk',
            name: 'coin-desk',
            component: CoinDeskView
        },
        {
            path: '/rewards',
            name: 'rewards',
            component: () => import('@/views/rewards/AllRewardView.vue')
        },
        {
            path: '/rewards/:id',
            name: 'rewards.show',
            component: () => import('@/views/rewards/DetailView.vue')
        },
        {
            path: '/rewards/create',
            name: 'rewards.create',
            component: () => import('@/views/rewards/CreateView.vue')
        },
        {
            path: '/login',
            name: 'login',
            component: () => import('@/views/login-register/LoginView.vue')
        },
        {
            path: '/logout',
            name: 'logout',
            component: () => import('@/views/LogoutView.vue')
        },
        {
            path: '/socket',
            name: 'socket-test',
            component: () => import('@/views/TestSocketView.vue')
        },
        {
            path: '/posts',
            name: 'posts',
            component: () => import('@/views/posts/AllPostView.vue')
        },
        {
            path: '/chat',
            name: 'chat',
            component: () => import('@/views/chat/AllChatView.vue')
        },
        {
            path: '/register',
            name: 'register',
            component: () => import('@/views/login-register/RegisterView.vue')
        },
        {
            path: '/nearby',
            name: 'nearby',
            component: () => import('@/views/posts/NearByPostView.vue')
        },
        {
            path: '/posts/:id',
            name: 'posts.show',
            component: () => import('@/views/posts/DetailView.vue')
        },
        {
            path: '/posts/precreate',
            name: 'posts.precreate',
            component: () => import('@/views/posts/PreCreateView.vue')
        },
        {
            path: '/posts/create/:is_lost',
            name: 'posts.create',
            component: () => import('@/views/posts/CreateView.vue')
        },
        {
            path: '/login/forgot',
            name: 'login.forgot',
            component: () => import('@/views/login-register/ForgotPasswordView.vue')
        },
    ]
})

export default router
