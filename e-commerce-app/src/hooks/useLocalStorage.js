import { useEffect, useState } from "react";

function useLocalStorage(name = "", initialValue = null) {
  const [value, setValue] = useState(() => {
    const storedValue = localStorage.getItem(name);
    return storedValue ? JSON.parse(storedValue) : initialValue;
  });

  useEffect(() => {
    localStorage.setItem(name, JSON.stringify(value));
  }, [value, name]);

  return [value, setValue];
}

export default useLocalStorage;
