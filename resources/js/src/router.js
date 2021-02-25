/*=========================================================================================
  File Name: router.js
  Description: Routes for vue-router. Lazy loading is enabled.
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

import Vue from "vue";
import Router from "vue-router";

Vue.use(Router);

const router = new Router({
    mode: "history",
    base: "/",
    scrollBehavior() {
        return { x: 0, y: 0 };
    },
    routes: [
        {
            path: "",
            redirect: "/pages/login"
        },

        {
            // =============================================================================
            // MAIN LAYOUT ROUTES
            // =============================================================================
            path: "",
            component: () => import("./layouts/main/Main.vue"),
            children: [
                // =============================================================================
                // Theme Routes
                // =============================================================================
                {
                    path: "/Home",
                    name: "Home",
                    component: () => import("./views/CLART/Home.vue")
                },
                {
                    path: "/NuevoCLARTEQ",
                    name: "NuevoCLARTEQ",
                    component: () => import("./views/CLART/NuevoCLARTEQ.vue")
                },
                {
                    path: "/NuevoCLARTAP",
                    name: "NuevoCLARTAP",
                    component: () => import("./views/CLART/NuevoCLARTAP.vue")
                },
                {
                    path: "/NuevoCLARTI",
                    name: "NuevoCLARTI",
                    component: () => import("./views/CLART/NuevoCLARTI.vue")
                },
                {
                    path: "/NuevoCLARTMI",
                    name: "NuevoCLARTMI",
                    component: () => import("./views/CLART/NuevoCLARTMI.vue")
                },
                {
                    path: "/ListadoCLARTAP",
                    name: "ListadoCLARTAP",
                    component: () => import("./views/CLART/ListadoCLARTAP.vue")
                },
                {
                    path: "/ListadoCLARTEQ",
                    name: "ListadoCLARTEQ",
                    component: () => import("./views/CLART/ListadoCLARTEQ.vue")
                },
                {
                    path: "/ListadoCLARTI",
                    name: "ListadoCLARTI",
                    component: () => import("./views/CLART/ListadoCLARTI.vue")
                },
                {
                    path: "/ListadoCLARTMI",
                    name: "ListadoCLARTMI",
                    component: () => import("./views/CLART/ListadoCLARTMI.vue")
                },
                {
                    path: "/ListadoCLART",
                    name: "ListadoCLART",
                    component: () => import("./views/CLART/ListadoCLART.vue")
                }
            ]
        },
        // =============================================================================
        // FULL PAGE LAYOUTS
        // =============================================================================
        {
            path: "",
            component: () => import("@/layouts/full-page/FullPage.vue"),
            children: [
                // =============================================================================
                // PAGES
                // =============================================================================
                {
                    path: "/pages/login",
                    name: "page-login",
                    component: () => import("@/views/pages/Login.vue")
                },
                {
                    path: "/pages/error-404",
                    name: "page-error-404",
                    component: () => import("@/views/pages/Error404.vue")
                }
            ]
        },
        // Redirect to 404 page, if no match found
        {
            path: "*",
            redirect: "/pages/error-404"
        }
    ]
});

router.afterEach(() => {
    // Remove initial loading
    const appLoading = document.getElementById("loading-bg");
    if (appLoading) {
        appLoading.style.display = "none";
    }
});

export default router;
