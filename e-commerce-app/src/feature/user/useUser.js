import { useQuery } from "@tanstack/react-query";
import { getUser } from "../../services/apiUser";

export function useUser(token) {
  const { data, isLoading, error, refetch } = useQuery({
    queryKey: ["user"],
    queryFn: getUser,
    enabled: Boolean(token),
  });

  return { data, isLoading, error, refetch };
}
