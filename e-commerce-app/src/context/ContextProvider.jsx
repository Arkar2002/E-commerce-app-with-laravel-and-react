import { createContext, useContext, useEffect, useState } from "react";
import useLocalStorage from "../hooks/useLocalStorage";
import { useUser } from "../feature/user/useUser";

const Context = createContext();

export default function ContextProvider({ children }) {
  const [token, setToken] = useLocalStorage("ACCESS_TOKEN");
  const [hasUser, setHasUser] = useState(false);
  const { data: user, isLoading } = useUser(token);

  useEffect(() => {
    if (!isLoading && user) setHasUser(Object.keys(user).length > 0);
  }, [user, isLoading, hasUser]);

  return (
    <Context.Provider
      value={{
        token,
        setToken,
        user,
        hasUser,
      }}
    >
      {children}
    </Context.Provider>
  );
}

export function useContextProvider() {
  const context = useContext(Context);
  if (!context) throw new Error("Context was used outside of context provider");
  return context;
}
