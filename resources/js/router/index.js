import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/dashboard',
      name: 'Dashboard',
      meta: {
        requiresAuth: true,
        title:"dashboard"
      },
      component: () => import('../views/Dashboard.vue')
    },
    {
      path: '/dubbing-requests',
      name: 'DubbingRequestsIndex',
      meta: {
        requiresAuth: true,
        title:"dubbing-requests"
      },
      component: () => import('../views/product/index.vue')
    },
    {
      path: '/dubbing-requests/my-requests',
      name: 'MyRequests',
      meta: {
        requiresAuth: true,
        title:"my-requests"
      },
      component: () => import('../views/product/myrequest.vue')
    },
    {
      path: '/login',
      name: 'Login',
      meta: {
        requiresAuth: false,
        title:"Login"
      },
      component: () => import('../views/auth/login.vue')
    },
    {
      path: '/register',
      name: 'Register',
      meta: {
        requiresAuth: false,
        title:"Register"
      },
      component: () => import('../views/auth/register.vue')
    },
    {
      path: '/profile',
      name: 'Profile',
      meta: {
        requiresAuth: true,
        title:"Profile"
      },
      component: () => import('../views/auth/profile.vue')
    },
    

    {
      path: '/:pathMatch(.*)',
      name: 'Notfound',
      meta: {
        requiresAuth: false
      },
      component: () => import('../views/auth/login.vue')
    },
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
  document.title = `${to.meta.title}`;
})

export default router
