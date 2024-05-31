/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';
import React from 'react';
import { createRoot } from 'react-dom/client';
import 'bootstrap/dist/css/bootstrap.min.css';
import NavBar from './components/NavBar';
import Parks from './components/Parks';
import Footer from './components/Footer';


const navBar = document.getElementById('navbar');
if (navBar) {
    createRoot(navBar).render(<NavBar/>);
}

/*
const parks = document.getElementById('parks');
if (parks) {
    createRoot(parks).render(<Parks/>);
}
*/


const footer = document.getElementById('footer');
if (footer) {
    createRoot(footer).render(<Footer/>);
}
