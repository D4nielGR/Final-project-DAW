import React from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faStar as regularStar, faStar as solidStar } from '@fortawesome/free-solid-svg-icons';
import '../../styles/park/Stars.css';

const StarRating = ({ rating }) => {
    const stars = [];
    const fullStars = Math.floor(rating);
    const halfStar = rating - fullStars >= 0.5;

    for (let i = 0; i < 5; i++) {
        stars.push(
            <span key={`dark-${i}`} className="star">
                <FontAwesomeIcon icon={regularStar} className="dark-star" />
                {i < fullStars && (
                    <FontAwesomeIcon icon={solidStar} className="light-star" style={{ color: 'gold' }} />
                )}
                {i === fullStars && halfStar && (
                    <FontAwesomeIcon icon={solidStar} className="light-star" style={{ color: 'gold', clipPath: 'inset(0 50% 0 0)' }} />
                )}
            </span>
        );
    }

    return <div className="star-rating">{stars}</div>;
};

export default StarRating;