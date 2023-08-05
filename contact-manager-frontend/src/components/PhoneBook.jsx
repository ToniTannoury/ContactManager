import React from 'react'
import { useState , useContext ,useEffect } from "react"
import ContactsContext from "../context/ContactController"
import ContactsList from "./ContactsList"
import "../styles/landing.css"
const PhoneBook = () => {
  const {contacts,fetchContacts} = useContext(ContactsContext)


  return (
    <div className='phoneBook'>
      <ContactsList/>
    </div>
  )
}

export default PhoneBook
