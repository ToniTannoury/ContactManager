import {useContext ,useEffect } from "react"
import ContactsContext from "../context/ContactController"
import ContactItem from "./ContactItem"
import React from 'react'

const ContactsList = () => {
  const { contacts, dispatch } = useContext(ContactsContext);
  useEffect(() => {
    const fetchProducts = async () => {
      const token = localStorage.getItem("token");
      const id = localStorage.getItem("id");
      console.log(id)
      const response =  await fetch(`http://127.0.0.1:8000/api/user/contacts/${id}` ,{
        method:"GET",
        headers:{
          "Authorization" : `Bearer ${token}`,
          "Accept":"application/json",
          "Content-Type":"application/json"
        }
      });

      if (response.ok) {
        const data = await response.json();
        console.log(data)
        dispatch({ type: 'populateContacts', payload: data});
      } else {
        console.error("Error fetching contacts:", response);
      }
    };

    fetchProducts();
  }, []);
  return (
    <div>
      <div className="headerContainer">
      <h1 className="contactsHeader">Your Contacts</h1>
      <button className="addContact">Add Contact</button>
      </div>
      
      {contacts?.map(contact=><ContactItem name={contact.name} phone_number={contact.phone_number} latitude={contact.latitude} longitude={contact.longitude} picture={contact.pic_url}/>)}
    </div>
  )
}

export default ContactsList
