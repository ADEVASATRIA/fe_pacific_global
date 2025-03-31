import { handleUnauthorized } from '../utils/api';

export function requireAuth() {
    const token = localStorage.getItem('jwt_token');
    if (!token) {
        handleUnauthorized();
        return false;
    }
    return true;
}

export function authGuard(to, from, next) {
    if (requireAuth()) {
        next();
    } else {
        next('/login');
    }
}