import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/dashboard',
      name: 'Dashboard',
      meta: {
        requiresAuth: true
      },
      component: () => import('../views/Dashboard.vue')
    },
    {
      path: '/dubbing-requests/index',
      name: 'DubbingRequestsIndex',
      meta: {
        requiresAuth: true
      },
      component: () => import('../views/product/index.vue')
    },
    {
      path: '/login',
      name: 'Login',
      meta: {
        requiresAuth: false
      },
      component: () => import('../views/auth/login.vue')
    }
  ]
})

router.beforeEach((to, from) => {
  // explicitly return false to cancel the navigation
  if (to.meta.requiresAuth && !localStorage.getItem('token')) {
    return { name: 'Login' }
  }
  if (to.meta.requiresAuth == false && localStorage.getItem('token')) {
    return { name: 'Dashboard' }
  }

})

export default router
