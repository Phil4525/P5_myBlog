// /*!
// * Start Bootstrap - Freelancer v7.0.6 (https://startbootstrap.com/theme/freelancer)
// * Copyright 2013-2022 Start Bootstrap
// * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-freelancer/blob/master/LICENSE)
// */
// //
// // Scripts
// // 

// window.addEventListener('DOMContentLoaded', event => {

//     // Navbar shrink function
//     let navbarShrink = function () {
//         const navbarCollapsible = document.body.querySelector('#mainNav');
//         if (!navbarCollapsible) {
//             return;
//         }
//         if (window.scrollY === 0) {
//             navbarCollapsible.classList.remove('navbar-shrink')
//         } else {
//             navbarCollapsible.classList.add('navbar-shrink')
//         }

//     };

//     // Shrink the navbar 
//     navbarShrink();

//     // Shrink the navbar when page is scrolled
//     document.addEventListener('scroll', navbarShrink);

//     // Activate Bootstrap scrollspy on the main nav element
//     const mainNav = document.body.querySelector('#mainNav');
//     if (mainNav) {
//         new bootstrap.ScrollSpy(document.body, {
//             target: '#mainNav',
//             offset: 72,
//         });
//     };

//     // Collapse responsive navbar when toggler is visible
//     const navbarToggler = document.body.querySelector('.navbar-toggler');
//     const responsiveNavItems = [].slice.call(
//         document.querySelectorAll('#navbarResponsive .nav-link')
//     );
//     responsiveNavItems.map(function (responsiveNavItem) {
//         responsiveNavItem.addEventListener('click', () => {
//             if (window.getComputedStyle(navbarToggler).display !== 'none') {
//                 navbarToggler.click();
//             }
//         });
//     });

// });

/*!
* Start Bootstrap - Freelancer v7.0.6 (https://startbootstrap.com/theme/freelancer)
* Copyright 2013-2022 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-freelancer/blob/master/LICENSE)
*/
window.addEventListener("DOMContentLoaded", (e => { let n = function () { const e = document.body.querySelector("#mainNav"); e && (0 === window.scrollY ? e.classList.remove("navbar-shrink") : e.classList.add("navbar-shrink")) }; n(), document.addEventListener("scroll", n); document.body.querySelector("#mainNav") && new bootstrap.ScrollSpy(document.body, { target: "#mainNav", offset: 72 }); const o = document.body.querySelector(".navbar-toggler");[].slice.call(document.querySelectorAll("#navbarResponsive .nav-link")).map((function (e) { e.addEventListener("click", (() => { "none" !== window.getComputedStyle(o).display && o.click() })) })) }));