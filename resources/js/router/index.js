import Vue from "vue";
import VueRouter from "vue-router";
import Store from "@/store";

const LoginPage = () =>
    import ("@/views/login");
const SiteDashboard = () =>
    import ("@/views/dashboard");

const AboutPage = () =>
    import ("@/views/about");
const ProdiPage = () =>
    import ("@/views/prodi/index");
const PeriodePage = () =>
    import ("@/views/periode/index");

Vue.use(VueRouter);

const routes = [{
        path: "/login",
        name: "login-page",
        component: LoginPage
    },
    {
        path: "/",
        name: "site-dashboard",
        component: SiteDashboard
    },

    {
        path: "/prodi",
        name: "prodi-page",
        component: ProdiPage
    },
    {
        path: "/about",
        name: "about-page",
        component: AboutPage
    },
    {
        path: "/periode",
        name: "periode-page",
        component: PeriodePage
    }
];

const router = new VueRouter({
    mode: "history",
    base: process.env.BASE_URL,
    routes
});

router.beforeEach((to, from, next) => {
    // Check Auth before each route
    if (to.name !== "login-page" && !Store.getters["auth/authenticated"]) {
        next({ name: "login-page" });
    } else {
        next();
    }
});

export default router;