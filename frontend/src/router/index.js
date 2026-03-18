/**
 * Application Router
 *
 * Configures application routes and implements authentication guards.
 *
 * Responsibilities:
 * - Define public and protected routes
 * - Redirect unauthenticated users from protected pages to login
 * - Redirect authenticated users away from guest-only pages
 * - Verify JWT token validity before granting access
 */

import { createRouter, createWebHistory } from 'vue-router'
import DashboardView from '@/views/DashboardView.vue'
import AuthenticationView from '@/views/AuthenticationView.vue'
import { checkToken } from '@/api/authApi'

// Route Definitions
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'dashboard',
      component: DashboardView,
      meta: { requiresAuth: true }, // Only accessible by authenticated users
    },
    {
      path: '/auth',
      name: 'auth',
      component: AuthenticationView,
      meta: { guestOnly: true }, // Only accessible by unauthenticated users
    },
  ],
})

// Global Navigation Guard
router.beforeEach(async (to, from, next) => {
  const token = localStorage.getItem('token')

  // Protected routes: verify token and redirect if missing/invalid
  if (to.meta.requiresAuth) {
    if (!token) {
      return next({ name: 'auth' })
    }
    try {
      await checkToken() // Validate token with server
      return next()
    } catch (err) {
      localStorage.removeItem('token')
      return next({ name: 'auth' })
    }
  }

  // Guest-only routes: redirect logged-in users to dashboard
  if (to.meta.guestOnly && token) {
    try {
      await checkToken()
      return next({ name: 'dashboard' })
    } catch (err) {
      localStorage.removeItem('token')
      return next()
    }
  }

  // Allow navigation if no guards are triggered
  next()
})

export default router
