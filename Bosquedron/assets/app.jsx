/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import React from 'react';
import { createRoot } from 'react-dom/client';
import 'bootstrap/dist/css/bootstrap.min.css';
import NavBar from './components/base/NavBar';
import Reviews from './components/park/Reviews';
import NewReview from './components/park/NewReview';

// base.html.twig
const navBar = document.getElementById('navbar');
if (navBar) { createRoot(navBar).render(<NavBar/>); }


//park.html.twig
const reviews = document.getElementById('reviews');
if (reviews) { 
    const parkId = reviews.getAttribute('data-park-id');
    createRoot(reviews).render(<Reviews parkId={parkId}/>); 
}

const newReview = document.getElementById('newReview');
if (newReview) {
    const parkId = newReview.getAttribute('data-park-id');
    const userId = newReview.getAttribute('data-user-id');
    createRoot(newReview).render(<NewReview parkId={parkId} userId={userId} />);
}