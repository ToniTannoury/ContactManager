import React from 'react';
import { FaEdit, FaTrash, FaUser, FaPhone, FaMapMarkerAlt ,FaMap} from 'react-icons/fa';
import "../styles/contactItem.css"
const ContactItem = ( { name, phone_number, picture, longitude, latitude } ) => {
 

  return (
    <div className='contactContainer'>
      <div className='contact'>
        <div className='contactImage'>
          <img src={picture} alt='Profile' />
        </div>
        <div className='contactInfo'>
          <h3>
            <FaUser /> {name}
          </h3>
          <p>
            <FaPhone /> {phone_number}
          </p>
          <p>
            <FaMapMarkerAlt /> Longitude:{longitude}, Latitude: {latitude}
          </p>
        </div>
        <div className='contactActions'>
          <button >
            <FaEdit /> Edit
          </button>
          <button>
            <FaTrash /> Delete
          </button>
          <button>
            <FaMap /> Show location
          </button>
        </div>
      </div>
    </div>
  );
};

export default ContactItem;