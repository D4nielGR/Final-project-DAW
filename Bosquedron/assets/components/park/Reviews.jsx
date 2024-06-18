import React, { useEffect, useState } from 'react';
import '../../styles/park/Reviews.css';
import StarRating from './StarRating';
import config from '../ip.js';

const apiUrl = config.apiUrl;

const Reviews = ({ parkId, rating }) => {
    const [reviews, setReviews] = useState([]);
    const [totalReviews, setTotalReviews] = useState([]);
    const [averageReviews, setAverageReviews] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    const [sortBy, setSortBy] = useState('date');
    const [sortOrder, setSortOrder] = useState('desc');


    const fetchReviews = async () => {
        try {
            const response = await fetch(`${apiUrl}/review/${parkId}`);
            if (!response.ok) {throw new Error('Error al obtener los datos de las reviews');}
            const data = await response.json();
            setReviews(data.reviews);
            setTotalReviews(data.totalReviews);
            setAverageReviews(data.averageReviews.toFixed(2));
            const sortedReviews = data.reviews.sort((a, b) => {
                let comparison = 0;
                if (sortBy === 'date') {
                    comparison = new Date(a.reviewDate) - new Date(b.reviewDate);
                } else if (sortBy === 'valoration') {
                    comparison = b.valoration - a.valoration;
                }
                return sortOrder === 'asc' ? comparison : -comparison;
            });
            setLoading(false);
        } catch (error) {
            setError(error.message);
            setLoading(false);
        }
    };


    useEffect(() => {
        fetchReviews();
    }, [parkId, sortBy, sortOrder]);


    const handleSortChange = (event) => { setSortBy(event.target.value); };

    const toggleSortOrder = () => { setSortOrder(sortOrder === 'asc' ? 'desc' : 'asc'); };

    if (loading) { return <div>Cargando...</div>; }
    if (totalReviews.length === 0) { return <div>No hay reviews disponibles.</div>; }
    if (error) { return <div>Error: {error.message}</div>; }

    return (
        <div>
            <div className='row row-cols-2'>
                <div className="col reviews-summary">
                    <h2 className="subtitle">{totalReviews} reseñas en total</h2>
                    <h3 className="subsubtitle">Promedio de reseñas: {averageReviews}</h3>
                </div>

                <div className="col order-md-last select-container sort-options">
                    <span className="sort-label">Ordenar por:</span>
                    <select value={sortBy} onChange={handleSortChange}>
                        <option value="date">fecha</option>
                        <option value="valoration">valoración</option>
                    </select>

                    <button className="sort-button" onClick={toggleSortOrder}>
                        {sortOrder === 'asc' ? '▲' : '▼'}
                    </button>
                </div>
            </div>
            
            <div>
                {reviews.map(review => (
                    <div key={review.id} className="review-container">
                        <div className="user-info">
                            <div className="user-photo">
                                <img src={review.userphoto} alt="User" />
                            </div>
                            <p className="username">{review.username}</p>
                        </div>

                        <div className="review-content">
                            <div className="rating m-0">
                                <StarRating rating={review.valoration} />
                            </div>

                            <div className="review-details m-0">
                                <p className="review-text mt-0 mb-4">{review.reviewText}</p>
                                <p className="review-date">{new Date(review.reviewDate).toLocaleDateString()}</p>
                            </div>
                        </div>
                    </div>
                ))}
            </div>
        </div>
    );
};

export default Reviews;