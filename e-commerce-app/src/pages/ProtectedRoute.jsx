import { useEffect } from "react";
import { GetUserFromApi } from "../hooks/GetUserFromApi";

function ProtectedRoute({ children }) {
  const { token, refetch } = GetUserFromApi();

  useEffect(() => {
    if (token) {
      console.log("refetching");
    }
  }, [token, refetch]);

  return children;
}

export default ProtectedRoute;
