import { createContext , useState , useEffect ,useReducer} from "react";

const ContactsContext = createContext()

export const ContactsProvider = ({ children }) => {
  const initialState = [];
  const reducer = (state, action) => {
    switch (action.type) {
      case 'populateContacts':
        return action.payload;
      default:
        return state;
    }
  };

  const [contacts, dispatch] = useReducer(reducer, initialState);

  return (
    <ContactsContext.Provider value={{ contacts, dispatch }}>
      {children}
    </ContactsContext.Provider>
  );
};

export default ContactsContext