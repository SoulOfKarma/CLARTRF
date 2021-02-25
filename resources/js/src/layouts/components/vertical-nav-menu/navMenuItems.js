/*=========================================================================================
  File Name: sidebarItems.js
  Description: Sidebar Items list. Add / Remove menu items from here.
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

export default [
    {
        url: "/Home",
        name: "Inicio",
        slug: "Inicio",
        icon: "HomeIcon"
    },
    {
        url: null,
        name: "Equipos Medicos",
        slug: "equiposmedicos",
        icon: "UserCheckIcon",
        submenu: [
            {
                url: "/NuevoCLARTEQ",
                name: "Nuevo CL ART",
                slug: "Nuevo CL ART",
                icon: "HomeIcon"
            },
            {
                url: "/ListadoCLARTEQ",
                name: "Listado CL ART",
                slug: "Listado CL ART",
                icon: "HomeIcon"
            }
        ]
    },
    {
        url: null,
        name: "Industrial",
        slug: "industrial",
        icon: "UserCheckIcon",
        submenu: [
            {
                url: "/NuevoCLARTI",
                name: "Nuevo CL ART",
                slug: "Nuevo CL ART",
                icon: "HomeIcon"
            },
            {
                url: "/ListadoCLARTI",
                name: "Listado CL ART",
                slug: "Listado CL ART",
                icon: "HomeIcon"
            }
        ]
    },
    {
        url: null,
        name: "Apoyo Clinico",
        slug: "apoyoclinico",
        icon: "UserCheckIcon",
        submenu: [
            {
                url: "/NuevoCLARTAP",
                name: "Nuevo CL ART",
                slug: "Nuevo CL ART",
                icon: "HomeIcon"
            },
            {
                url: "/ListadoCLARTAP",
                name: "Listado CL ART",
                slug: "Listado CL ART",
                icon: "HomeIcon"
            }
        ]
    },
    {
        url: null,
        name: "Mantencion/Infraestructura",
        slug: "mantencioninfraestructura",
        icon: "UserCheckIcon",
        submenu: [
            {
                url: "/NuevoCLARTMI",
                name: "Nuevo CL ART",
                slug: "Nuevo CL ART",
                icon: "HomeIcon"
            },
            {
                url: "/ListadoCLARTMI",
                name: "Listado CL ART",
                slug: "Listado CL ART",
                icon: "HomeIcon"
            }
        ]
    },
    {
        url: "/ListadoCLART",
        name: "Listado Total ART",
        slug: "ListadoCLART",
        icon: "HomeIcon"
    }
];
